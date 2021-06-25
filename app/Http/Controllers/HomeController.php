<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armada;
use App\Models\TipeArmada;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Crypt;
use App\Lib\MyHelper;

class HomeController extends Controller
{
    public function index(){
        return view('guest/home');
    }

    public function katalog(){
        $response['armada'] = Armada::with('tipe_armada')->where('status_armada', 'ready')->groupBy('id_tipe_armada')->get();

        return view('guest/katalog', $response);
    }

    public function kontak(){
        $response['kontak'] = [];

        return view('guest/kontak', $response);
    }

    public function booking(Request $r){
        $tipe_armada = TipeArmada::with(['armada' => function($query){
            $query->where('status_armada', 'ready');
        }])->get()->toArray();

        $data['tipe_armada'] = array();
        foreach($tipe_armada as $tipe){
            if(isset($tipe['armada'][0]))
                $tipe['armada'][0] = array_merge($tipe['armada'][0], ['is_driver_allowed' => $tipe['is_driver_allowed']]);

            $data['tipe_armada'][$tipe['tipe']] = $tipe['armada'];
        }

        $data['price_pengambilan_dikirim'] = Setting::where('key', 'tambahan_harga_pengambilan_dikirim')->first()['value'] ?? 0;
        $data['price_lepas_kunci_dikirim'] = Setting::where('key', 'tambahan_harga_lepas_kunci_dikirim')->first()['value'] ?? 0;
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');
        $data['cat_id_tipe_armada'] = $r->get('id_tipe_armada') ?? null;
        // dd($data);
        return view('guest.booking', $data);
    }

    public function prasyarat(Request $r){
        $prayarat = Setting::where('key', 'syarat_dan_jaminan')->first()['value'] ?? '';

        return view('guest.prasyarat', ['prasyarat' => $prayarat, 'no_faktur' => Crypt::decryptString($r->get('no_faktur'))]);
    }

    public function uploadKwitansi(Request $request){
        try{
            $token = $request->get('token');

            $cek = evo_decrypt($token);

            if(!empty($token)){
                return view('guest.upload_kwitansi', ['token' => $token]);
            }else{
                return redirect('home');
            }

        }catch(\Throwable $th){
            return redirect('home');
        }
    }

    public function storeKwitansi(Request $request){
        try{
            $no_faktur = evo_decrypt($request->get('token'));

            $result = MyHelper::uploadImagePublic('\image\kwitansi\\');

            if(isset($result['status']) && $result['status'] == 'success'){
                $filepath = $result['filename'];

                $tr = Transaction::where('nomor_faktur', $no_faktur);
                if($tr->first()){
                    $tr->update([
                        'foto_kwitansi' => $filepath
                    ]);
                }

                return redirect()->back()->withSuccess(['Successfully to upload kwitansi']);
            }

            return redirect()->back()->withErrors('Failed to upload kwitansi');
        }catch(\Throwable $th){
            return redirect()->back()->withErrors('Something Went Wrong');
        }

    }
}
