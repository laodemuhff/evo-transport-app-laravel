<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Transaction;
use App\Models\TipeArmada;
use App\Models\Armada;
use App\Models\Setting;
use App\Lib\MyHelper;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function create()
    {
        $tipe_armada = TipeArmada::with(['armada' => function($query){
            $query->where('status_armada', 'ready');
        }])->get()->toArray();
        
        $data['tipe_armada'] = array(); 
        foreach($tipe_armada as $tipe){
            $data['tipe_armada'][$tipe['tipe']] = $tipe['armada'];
        }

        $data['price_pengambilan_dikirim'] = Setting::where('key', 'tambahan_harga_pengambilan_dikirim')->first()['value'] ?? 0;
        $data['price_lepas_kunci_dikirim'] = Setting::where('key', 'tambahan_harga_lepas_kunci_dikirim')->first()['value'] ?? 0;
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');
        //dd($data);
        return view('transaction::create', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->except('_token');

        // dd($post);
        
        $post['grand_total'] = str_replace(['Rp', 'Rp.', ' ', '.', ','], '', $post['grand_total']);
        $post['pickup_date'] = Self::format_date($post['pickup_date']);

        $rules = [
            'nama_customer'      => [ 'required' ],
            'alamat_customer'    => [ 'required' ],
            'no_hp_customer'     => [ 'required', 'unique:transactions,no_hp_customer', 'phone_number_indo', 'min:11', 'max:13'],
            'id_armada'          => [ 'required', 'numeric' ],
            'durasi_sewa'        => [ 'required', 'numeric' ],
            'pickup_date'        => [ 'required', 'date' ],
            'status_lepas_kunci' => [ Rule::in([null, 'off key', 'shipped off key']) ],
            'status_pengambilan' => [ Rule::in([null, 'taken in place', 'send out car']) ],
            'grand_total'        => [ 'required','numeric' ],
        ];

        $messages = [
            'no_hp_customer.phone_number_indo' => ':attribute must begin with 08 or 62',
            'status_lepas_kunci.in' => ':attribute is not included on the list',
            'status_pengambilan.in' => ':attribute is not included on the list'
        ];

        $validator = Validator::make($post, $rules, $messages);

        if(!empty($validator->errors()->messages())){
            $request->flash();
            return redirect()->back()->withErrors($validator->errors()->messages());
        }

        try {
            unset($post['tipe_armada']);
            $last_order = Transaction::orderBy('created_at', 'desc')->first()['nomor_faktur'] ?? null;
            $post['nomor_faktur'] = MyHelper::generateNomorFaktur($last_order);
            $post['status_transaksi'] = 'pending';

            // dd($post);

            $store_transaction = Transaction::create($post);

            if($store_transaction){
                DB::commit();
                return redirect('transaction/list/pending')->with('success',['Success create transaction']);

            }else{
                $request->flash();
                DB::rollback();
                return redirect()->back()->withErrors('create transaction failed');
            }
        } catch (\Throwable $th) {
            $request->flash();
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function index($status){
        $data['transaction'] = Transaction::with(['armada' => function($query){
                $query->with('tipe_armada');
            }
        ])
        ->where('status_transaksi', $status)
        ->where('is_deleted', 0)
        ->get();

        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');
        $data['status'] = $status;

        return view('transaction::index', $data);
    }

    public function table(Request $request, $status){
        $post = $request->all();

        $data = Transaction::select('transactions.*', 'armadas.kode_armada as kode_armada', 'armadas.price as harga_sewa', 'tipe_armadas.tipe as tipe_armada')
                            ->join('armadas', 'armadas.id', 'transactions.id_armada')
                            ->join('tipe_armadas', 'tipe_armadas.id', 'armadas.id_tipe_armada')
                            ->where('status_transaksi', str_replace('_',' ',$status))
                            ->where('is_deleted', 0);

        if (isset($post['nama_customer']))
            $data->where('nama_customer', 'LIKE', '%'.$post['nama_customer'].'%');

        if (isset($post['alamat_customer']))
            $data->where('alamat_customer', 'LIKE', '%'.$post['alamat_customer'].'%');
            
        if (isset($post['no_hp_customer']))
            $data->where('no_hp_customer', 'LIKE', '%'.$post['no_hp_customer'].'%');

        if (isset($post['nomor_faktur']))
            $data->where('nomor_faktur', 'LIKE', '%'.$post['nomor_faktur'].'%');

        if (isset($post['durasi_sewa']))
            $data->where('durasi_sewa', $post['durasi_sewa']);

        if (isset($post['pickup_date']))
            $data->whereDate('pickup_date', $post['pickup_date']);

        if (isset($post['status_lepas_kunci'])){
            if($post['status_lepas_kunci'] == 'none'){
                $data->whereNull('status_lepas_kunci');
            }else{
                $data->where('status_lepas_kunci', $post['status_lepas_kunci']);
            }
        }

        if (isset($post['status_pengambilan'])){
            if($post['status_pengambilan'] == 'none'){     
                $data->whereNull('status_pengambilan');
            }else{
                $data->where('status_pengambilan', $post['status_pengambilan']);
            }
        }

        $data = $data->orderBy('created_at','desc')->get()->toArray();

        if (isset($post['tipe_armada'])){
            $data = array_filter($data, function($item) use($post){
                return $item['tipe_armada'] == $post['tipe_armada'];
            });
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                if($data['status_lepas_kunci'] == null){
                    return "<a href='".route('transaction.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='hapus ".$data['nomor_faktur']."' style='width:35px; padding: 8px !important'><i class='la la-trash'></i></a><a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx".$data['id']."' title='detail ".$data['nomor_faktur']."'><i class='la la-eye'></i></a><a href='".route('transaction.assign.driver',[encSlug($data['id'])])."' class='btn btn-success btn-sm btn-success' title='assign to driver' style='width:35px; padding: 8px !important'><i class='la la-user'></i></a>";
                }else{
                    return "<a href='".route('transaction.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='hapus ".$data['nomor_faktur']."' style='width:35px; padding: 8px !important'><i class='la la-trash'></i></a><a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx".$data['id']."' title='detail ".$data['nomor_faktur']."'><i class='la la-eye'></i></a>";
                }
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addColumn('kode_armada', function($data){
                return $data['kode_armada'];
            })
            ->addColumn('tipe_armada', function($data){
                return $data['tipe_armada'];
            })
            ->addColumn('harga_sewa', function($data){
                return $data['harga_sewa'];
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    // public function edit($id){
    //     $id = decSlug($id);
    //     $armada = Armada::where('id', $id)->first();

    //     if ($armada) {
    //         $data['armada'] = $armada;
    //         $data['tipe_armada'] = TipeArmada::all()->toArray();
    //         $data['status_armada'] = Armada::getEnumValues('status_armada');
    //         $data['status_driver'] = Armada::getEnumValues('status_driver');
    //     }

    //     return view('armada::edit', $data);
    // }

    // public function update(Request $request, $id){
    //     DB::beginTransaction();
    //     $post = $request->except("_token");
        
    //     $id = decSlug($id);

    //     try {
    //         if(isset($post['photo'])){
    //             $result = MyHelper::uploadImagePublic('\image\armada\\');
    //         }else{
    //             $result['status'] = 'success';
    //         }

    //         if(isset($result['status']) && $result['status'] == 'success'){
    //             if(isset($post['photo'])){
    //                 $post['photo'] = asset(str_replace('\\', '/', $result['filename']));
    //             }
    //             $post['price'] = str_replace(['Rp', ','], '', $post['price']);
                
    //             $armada = Armada::where('id',$id)->update($post);

    //             DB::commit();
    //             return redirect()->back()->with('success',['Success update armada']);
    //         }else{
    //             DB::rollback();

    //             if(isset($result['message'])) return redirect()->back()->withErrors($result['message']);

    //             return redirect()->back()->withErrors('update armada failed');
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         return redirect()->back()->withErrors('Galat : '.$th->getMessage());
    //     }
    // }

    public function delete($id){
        $id = decSlug($id);
        return Transaction::where('id', $id)->update(['is_deleted' => 1]);
    }

    public function confirmRent(Request $request){
        $post = $request->all();
        $update = Transaction::where('id', $post['id'])->update(['status_transaksi' => 'on rent']);

        if($update){
            return redirect('transaction/list/on_rent')->with('success',['Transaction is successfully confirmed']);
        }else{
            return redirect()->back()->withErrors('Failed to confirm transaction');
        }
    }

    public function requirements(){
        $data['requirements'] = Setting::where('key', 'syarat_dan_jaminan')->first()['value'];

        return view('transaction::requirements', $data);
    }

    public function updateRequirements(Request $request){
        $post = $request->except('_token');

        $update = Setting::where('key', 'syarat_dan_jaminan')->update($post);

        if($update){
            return redirect()->back()->with('success', ['Succesfully Update Syarat & Jaminan']);
        }else{
            $request->flash();
            return redirect()->back()->withErrors('Failed to update Syarat & Jaminan');
        }
    }

    public function getNotif(){
        $data['pending'] = Transaction::where('status_transaksi','pending')->where('is_deleted', 0)->get()->count();
        $data['on_rent'] = Transaction::where('status_transaksi','on rent')->where('is_deleted', 0)->get()->count();

        return response()->json($data);
    }

    public function format_date($datetimepicker_date){
        $date = explode(' ', $datetimepicker_date);

        $year = $date[2] ?? date('Y');
        $day = $date[0] ?? date('d');
        $time = $date[4] ?? date('H:i:s');

        switch($date[1]){
            case 'Jan' : $month = '01';break;
            case 'Feb' : $month = '02';break;
            case 'Mar' : $month = '03';break;
            case 'Apr' : $month = '04';break;
            case 'May' : $month = '05';break;
            case 'Jun' : $month = '06';break;
            case 'Jul' : $month = '07';break;
            case 'Aug' : $month = '08';break;
            case 'Sep' : $month = '09';break;
            case 'Oct' : $month = '10';break;
            case 'Nov' : $month = '11';break;
            case 'Des' : $month = '12';break;
            default : $month = date('m');
        }

        return $year.'-'.$month.'-'.$day.' '.$time;
    }
}
