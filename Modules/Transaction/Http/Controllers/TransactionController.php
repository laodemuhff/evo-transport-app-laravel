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
use Auth;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{

    public function index($status){
        $data['transaction'] = Transaction::with(['armada' => function($query){
                $query->with('tipe_armada');
            }
        ])
        ->where('status_transaksi', str_replace('_', ' ', $status))
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

        $data = Transaction::select('transactions.*', 'armadas.kode_armada as kode_armada', 'tipe_armadas.tipe as tipe_armada')
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
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $data['tipe_armada'] = array_filter(TipeArmada::with(['armada' => function($query){
                                    $query->where('status_armada', 'ready');
                                }])->get()->toArray(), function($item){
                                    return !empty($item['armada']);
                                });

        // $data['tipe_armada'] = array();
        // foreach($tipe_armada as $tipe){
        //     $data['tipe_armada'][$tipe['tipe']] = $tipe['armada'];
        // }

        $data['price_pengambilan_dikirim'] = Setting::where('key', 'tambahan_harga_pengambilan_dikirim')->first()['value'] ?? 0;
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');
        // dd($data);
        return view('transaction::create', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->except('_token');

        // dd($post);
        $post['pickup_date'] = Self::format_date($post['pickup_date']);

        $rules = [
            'nama_customer'      => [ 'required' ],
            'alamat_customer'    => [ 'required' ],
            'no_hp_customer'     => [ 'required', 'unique:transactions,no_hp_customer', 'phone_number_indo', 'min:11', 'max:13'],
            'durasi_sewa'        => [ 'required', 'numeric' ],
            'pickup_date'        => [ 'required', 'date' ],
            'status_lepas_kunci' => [ Rule::in([null, 'off key', 'with driver']) ],
            'status_pengambilan' => [ Rule::in([null, 'taken in place', 'send out car']) ],
        ];

        if(!empty($post['id_armada'])){
            $rules['id_armada'] = [ 'required', 'numeric' ];
        }else{
            $cek_armada = Armada::where('id_tipe_armada', $post['tipe_armada'])->where('status_armada', 'ready')->first();

            if($cek_armada){
                $post['id_armada'] = $cek_armada['id'];
            }else{
                $request->flash();
                return redirect()->back()->withErrors('Out of Armadas');
            }
        }

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
            $last_order = Transaction::orderBy('created_at', 'desc')->first()['nomor_faktur'] ?? null;
            $post['nomor_faktur'] = MyHelper::generateNomorFaktur($last_order);
            $post['status_transaksi'] = 'pending';
            $post['return_date'] = date('Y-m-d H:i:s', strtotime('+'.$post['durasi_sewa'].' hours', strtotime($post['pickup_date'])));
            // dd($post);

            $request_cek_harga = new \Illuminate\Http\Request();

            $request_cek_harga->replace([
                'id_tipe_armada' => $post['tipe_armada'],
                'durasi' => $post['durasi_sewa'],
                'status_pengambilan' => $post['status_pengambilan'],
                'status_lepas_kunci' => $post['status_lepas_kunci']
            ]);

            $post['grand_total'] = json_decode(json_encode(Self::cekHargaSewa($request_cek_harga)), true)['original']['grand_total_real'] ?? null;

            if(empty($post['grand_total'])){
                $request->flash();
                return redirect()->back()->withErrors('create transaction failed');
            }

            unset($post['tipe_armada']);
            $store_transaction = Transaction::create($post);

            if($store_transaction){

                Armada::where('id', $post['id_armada'])->update([
                    'status_armada' => 'not ready'
                ]);

                DB::commit();

                if(!empty($post['guest_booking'])){
                    return redirect('prasyarat?no_faktur='.Crypt::encryptString($post['nomor_faktur']))->with('success', ['Success create transaction']);
                }

                return redirect()->back()->with('success',['Success create transaction']);

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

    public static function cekHargaSewa(Request $request){
        $id_tipe_armada  = $request->id_tipe_armada;
        $durasi = $request->durasi;
        $status_pengambilan = $request->status_pengambilan;
        $status_lepas_kunci = $request->status_lepas_kunci;

        $total = 0;

        $tipe_armada = TipeArmada::find($id_tipe_armada);

        if($durasi % 24 == 0){
            $days = $durasi / 24;
            $half_days = 0;
        }
        else{
            $days = floor($durasi / 24);
            $half_days = 1;
        }

        if($status_lepas_kunci == 'with driver'){
            $price12 = $tipe_armada['price_driver12'];
            $price24 = $tipe_armada['price_driver'];
        }else{
            $price12 = $tipe_armada['price12'];
            $price24 = $tipe_armada['price'];
        }

        $grand_total = ($price24 * $days) + ($price12 * $half_days);

        $tambahan_pengiriman_mobil = 0;
        if($status_pengambilan == 'send out car'){
            $tambahan_pengiriman_mobil = Setting::where('key', 'tambahan_harga_pengambilan_dikirim')->first()['value'] ?? 0;
            $grand_total += $tambahan_pengiriman_mobil;
        }

        $durasi = '';

        if($days > 0)
            $durasi .= $days.' Days';

        if($half_days > 0){
            if($days > 0)
                $durasi .= ' And ';

            $durasi .= '12 Hour';
        }

        $response = [
            'grand_total_real' => $grand_total,
            'grand_total' => 'Rp '.number_format($grand_total,0,',','.'),
            'price12' => 'Rp '.number_format($price12,0,',','.').'<b> x '.$half_days.'</b>',
            'price24' => 'Rp '.number_format($price24,0,',','.').'<b> x '.$days.'</b>',
            'durasi' => $durasi,
            'status_lepas_kunci' => $status_lepas_kunci == 'off key' ? 'Lepas Kunci' : 'Mobil + Driver',
            'status_pengambilan' => $status_pengambilan == 'taken in place' ? 'Ambil di Tempat' : 'Mobil Dikirimakn',
            'penambahan_harga' =>  'Rp '.number_format($tambahan_pengiriman_mobil,0,',','.')
        ];

        return response()->json($response);
    }

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

    public function cancelRent(Request $request){
        $post = $request->except('_token');

        $transaction = Transaction::where('id', $post['id']);

        $post['status_transaksi'] = 'cancelled';
        $post['cancelled_by'] = Auth::user()->email;
        $update = $transaction->update($post);

        if($update){
            $transaction = $transaction->first();
            Armada::where('id', $transaction['id_armada'])->update([
                'status_armada' => 'ready'
            ]);
            return redirect('transaction/list/cancelled')->with('success',['Transaction is successfully cancelled']);
        }else{
            return redirect()->back()->withErrors('Failed to cancel transaction');
        }
    }

    public function successRent(Request $request){
        $post = $request->except('_token');

        $transaction = Transaction::where('id', $post['id']);

        $post['status_transaksi'] = 'success';
        $post['customer_return_date'] = date('Y-m-d H:i:s');
        $update = $transaction->update($post);

        if($update){
            $transaction = $transaction->first();
            Armada::where('id', $transaction['id_armada'])->update([
                'status_armada' => 'ready'
            ]);
            return redirect('transaction/list/success')->with('success',['Transaction is successfully mark as returned']);
        }else{
            return redirect()->back()->withErrors('Failed to mark transaction as returned');
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
