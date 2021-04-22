<?php

namespace Modules\Armada\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\TipeArmada;
use App\Models\Armada;
use App\Lib\MyHelper;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ArmadaController extends Controller
{
    public function create()
    {
        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_armada'] = Armada::getEnumValues('status_armada');

        // dd($data);
        return view('armada::create', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->except('_token');

        $request->validate([
            'id_tipe_armada' => 'required',
            'kode_armada' => 'required|unique:armadas,kode_armada',
            'status_armada' => 'required'
        ]);

        //dd($post);
        try {
            $save = Armada::create($post);

            if($save){
                DB::commit();
                return redirect()->back()->with('success',['Sukses Menambahkan Armada']);
            }else{
                DB::rollback();
                return redirect()->back()->withErrors('Armada Gagal Disimpan');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function index(){
        $data['armada'] = Armada::with('tipe_armada')->get();
        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_armada'] = Armada::getEnumValues('status_armada');

        return view('armada::index', $data);
    }

    public function table(Request $request){
        $post = $request->all();

        $data = Armada::with('tipe_armada');

        if (isset($post['kode_armada']))
            $data->where('kode_armada', 'LIKE', '%'.$post['kode_armada'].'%');
        if (isset($post['id_tipe_armada']))
            $data->where('id_tipe_armada', $post['id_tipe_armada']);
        if (isset($post['status_armada']))
            $data->where('status_armada', $post['status_armada']);

        $data = $data->orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='".route('armada.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i></a> &nbsp; <a href='".route('armada.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='".$data['kode_armada']."'><i class='flaticon2-trash'></i></a>";
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addColumn('tipe_armada', function($data){
                return $data->tipe_armada->tipe;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id){
        $id = decSlug($id);
        $armada = Armada::where('id', $id)->first();

        if ($armada) {
            $data['armada'] = $armada;
            $data['tipe_armada'] = TipeArmada::all()->toArray();
            $data['status_armada'] = Armada::getEnumValues('status_armada');
        }

        return view('armada::edit', $data);
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        $post = $request->except("_token");

        $id = decSlug($id);

        try {
            $armada = Armada::where('id',$id)->update($post);

            DB::commit();
            return redirect()->back()->with('success',['Sukses Update Armada']);

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }
    }

    public function delete($id){
        $id = decSlug($id);
        return Armada::destroy($id);
    }

    public function generateRandomCode(Request $request){
        $id = str_replace(' ', '', $request->get('id'));
        $code = $id.'-'.MyHelper::createrandom(4, null, '123456789');

        return response()->json(['code' => $code]);
    }
}
