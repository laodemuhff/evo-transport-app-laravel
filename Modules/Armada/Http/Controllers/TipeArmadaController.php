<?php

namespace Modules\Armada\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TipeArmada;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Validator;
use Illuminate\Validation\Rule;
use App\Lib\MyHelper;

class TipeArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['tipe_kemudi'] = TipeArmada::getEnumValues('tipe_kemudi');

        return view('armada::tipe_armada.index', $data);
    }

    public function create()
    {
        $data['tipe_kemudi'] = TipeArmada::getEnumValues('tipe_kemudi');

        // dd($data);
        return view('armada::tipe_armada.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $post = $request->all();

        $rule = [
            'tipe' => 'required|unique:tipe_armadas,tipe',
            'kapasitas_penumpang' => 'required',
            'tipe_kemudi' => 'required',
            'photo' => 'required|image'
        ];

        if(empty($post['price-check']) && empty($post['price12'])){
            $rule['price12'] = 'required';
        }

        $request->validate($rule);

        DB::beginTransaction();

        try{
            $post = $request->except('_token');

            $result = MyHelper::uploadImagePublic('\image\tipe_armada\\');

            if(isset($result['status']) && $result['status'] == 'success'){
                $post['photo'] = $result['filename'];

                if(isset($post['price12'])){
                    $post['price12'] = str_replace(['Rp', ','], '', $post['price12']);
                }

                if(isset($post['price'])){
                    $post['price'] = str_replace(['Rp', ','], '', $post['price']);
                }

                if(isset($post['price_driver12'])){
                    $post['price_driver12'] = str_replace(['Rp', ','], '', $post['price_driver12']);
                }

                if(isset($post['price_driver'])){
                    $post['price_driver'] = str_replace(['Rp', ','], '', $post['price_driver']);
                }

                if(!empty($post['is_driver_allowed'])){
                    $post['is_driver_allowed'] = 1;
                }

                if(!empty($post['price-check'])){
                    unset($post['price-check']);
                }

                $save = TipeArmada::create($post);

                if($save){
                    DB::commit();
                    return redirect()->back()->withSuccess(['Tipe Armada Behasil Disimpan'] ?? 'Tipe Armada Behasil Disimpan');
                }
            }

            DB::rollback();
            return redirect()->back()->withErrors('Tipe Armada Gagal Disimpan');

        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function table(Request $request){
        $post = $request->all();

        $data = TipeArmada::select('*');

        if (isset($post['tipe']))
            $data->where('tipe', 'LIKE', '%'.$post['tipe'].'%');

        if (isset($post['kapasitas_penumpang'])){
            if($post['kapasitas_penumpang'] == '<= 5')
                $data->where('kapasitas_penumpang', '<=', 5);
            if($post['kapasitas_penumpang'] == '> 5')
                $data->where('kapasitas_penumpang', '>', 5);
        }

        if (isset($post['tipe_kemudi']))
            $data->where('tipe_kemudi', $post['tipe_kemudi']);

        if (isset($post['price'])){
            if($post['price'] == '< 200000')
                $data->where('price', '<', 200000);
            if($post['price'] == '>= 200000 AND <= 350000')
                $data->whereBetween('price', [200000, 350000]);
            if($post['price'] == '> 350000')
                $data->where('price', '>', 350000);
        }

        $data = $data->orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='".route('tipe_armada.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i></a> &nbsp; <a href='".route('tipe_armada.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='delete ".$data['tipe']."'><i class='flaticon2-trash'></i></a>";
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }


    public function edit($id){
        $id = decSlug($id);
        $tipe_armada = TipeArmada::where('id', $id)->first();

        if ($tipe_armada) {
            $data['tipe_armada'] = $tipe_armada;
            $data['tipe_kemudi'] = TipeArmada::getEnumValues('tipe_kemudi');
        }

        return view('armada::tipe_armada.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        $id = decSlug($id);

        $rule = [
            'tipe' => [
                'required',
                Rule::unique('tipe_armadas')->ignore($id)
            ],
            'kapasitas_penumpang' => 'required',
            'tipe_kemudi' => 'required',
            'photo' => 'image'
        ];

        $validator = Validator::make($post, $rule);

        if(!empty($validator->errors()->messages())){
            return redirect()->back()->withErrors($validator->errors()->messages());
        }

        DB::beginTransaction();

        try{
            if(isset($post['photo'])){
                $result = MyHelper::uploadImagePublic('\image\armada\\');

                if(isset($result['status']) && $result['status'] == 'success'){
                    $post['photo'] = $result['filename'];
                }
            }

            if(isset($post['price12'])){
                $post['price12'] = str_replace(['Rp', ','], '', $post['price12']);
            }else{
                $post['price12'] = null;
            }

            if(isset($post['price'])){
                $post['price'] = str_replace(['Rp', ','], '', $post['price']);
            }else{
                $post['price'] = null;
            }

            if(isset($post['price_driver12'])){
                $post['price_driver12'] = str_replace(['Rp', ','], '', $post['price_driver12']);
            }else{
                $post['price_driver12'] = null;
            }

            if(isset($post['price_driver'])){
                $post['price_driver'] = str_replace(['Rp', ','], '', $post['price_driver']);
            }else{
                $post['price_driver'] = null;
            }

            if(!empty($post['is_driver_allowed'])){
                $post['is_driver_allowed'] = 1;
            }else{
                $post['is_driver_allowed'] = 0;
            }

            if(!empty($post['price-check'])){
                unset($post['price-check']);
            }

            // dd($post);
            $save = TipeArmada::where('id', $id)->update($post);

            if($save){
                DB::commit();
                return redirect()->back()->withSuccess(['Tipe Armada Behasil Diubah'] ?? 'Tipe Armada Behasil Diubah');
            }

            DB::rollback();
            return redirect()->back()->withErrors(['Tipe Armada Gagal Diubah'] ?? 'Tipe Armada Gagal Diubah');

        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $id = decSlug($id);

        $delete = TipeArmada::where('id', $id)->delete();

        if($delete){
            return redirect()->back()->withErrors(['Tipe Armada sukses dihapus'] ?? 'Tipe Armada sukses dihapus');
        }

        return redirect()->back()->withErrors(['Tipe Armada gagal dihapus'] ?? 'Tipe Armada gagal dihapus');
    }
}
