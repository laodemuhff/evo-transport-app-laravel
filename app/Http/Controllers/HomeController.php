<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armada;
use App\Models\TipeArmada;
use App\Models\Setting;
use App\Models\Transaction;

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

    public function booking(){
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
        return view('guest.booking', $data);
    }
}
