<?php

use Illuminate\Database\Seeder;

class TipeArmadasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipe_armadas')->delete();
        
        \DB::table('tipe_armadas')->insert(array (
            0 => 
            array (
                'id' => 9,
                'tipe' => 'Agya',
                'kapasitas_penumpang' => 5,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 200000.0,
                'price12' => 150000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 350.0,
                'price_driver12' => 250.0,
                'photo' => '\\image\\tipe_armada\\AGYA.png',
                'created_at' => '2021-04-17 15:01:54',
                'updated_at' => '2021-04-17 15:43:47',
            ),
            1 => 
            array (
                'id' => 10,
                'tipe' => 'Ayla',
                'kapasitas_penumpang' => 7,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 200000.0,
                'price12' => 150000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 350.0,
                'price_driver12' => 250.0,
                'photo' => '\\image\\tipe_armada\\AYLA.png',
                'created_at' => '2021-04-17 15:48:08',
                'updated_at' => '2021-04-17 15:48:08',
            ),
            2 => 
            array (
                'id' => 11,
                'tipe' => 'All New Agya',
                'kapasitas_penumpang' => 5,
                'tipe_kemudi' => 'Manual',
                'price' => 250000.0,
                'price12' => 200000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 400.0,
                'price_driver12' => 300.0,
                'photo' => '\\image\\tipe_armada\\AGYA.png',
                'created_at' => '2021-04-17 15:49:13',
                'updated_at' => '2021-04-17 15:49:13',
            ),
            3 => 
            array (
                'id' => 12,
                'tipe' => 'New Brio',
                'kapasitas_penumpang' => 5,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 250000.0,
                'price12' => 200000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 400.0,
                'price_driver12' => 300.0,
                'photo' => '\\image\\tipe_armada\\NEW BRIO.png',
                'created_at' => '2021-04-17 15:50:49',
                'updated_at' => '2021-04-17 15:50:49',
            ),
            4 => 
            array (
                'id' => 13,
                'tipe' => 'All New Brio',
                'kapasitas_penumpang' => 7,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 275000.0,
                'price12' => 225000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 425.0,
                'price_driver12' => 325.0,
                'photo' => '\\image\\tipe_armada\\NEW BRIO.png',
                'created_at' => '2021-04-17 15:52:22',
                'updated_at' => '2021-04-17 15:52:22',
            ),
            5 => 
            array (
                'id' => 14,
                'tipe' => 'Mobilio',
                'kapasitas_penumpang' => 5,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 275000.0,
                'price12' => 225000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 425.0,
                'price_driver12' => 325.0,
                'photo' => '\\image\\tipe_armada\\mobil4.png',
                'created_at' => '2021-04-17 15:53:21',
                'updated_at' => '2021-04-17 15:53:21',
            ),
            6 => 
            array (
                'id' => 15,
                'tipe' => 'Grand New Avanza',
                'kapasitas_penumpang' => 8,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 275000.0,
                'price12' => 225000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 425.0,
                'price_driver12' => 325.0,
                'photo' => '\\image\\tipe_armada\\F53EA_T22_White_main_banner_toyota_new_avanza_white.png',
                'created_at' => '2021-04-17 15:55:24',
                'updated_at' => '2021-04-17 15:55:24',
            ),
            7 => 
            array (
                'id' => 16,
                'tipe' => 'Jazz RS',
                'kapasitas_penumpang' => 8,
                'tipe_kemudi' => 'Automatic',
                'price' => 300000.0,
                'price12' => 250000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 450.0,
                'price_driver12' => 350.0,
                'photo' => '\\image\\tipe_armada\\JAZZ RS.png',
                'created_at' => '2021-04-17 15:57:11',
                'updated_at' => '2021-04-17 15:57:11',
            ),
            8 => 
            array (
                'id' => 17,
                'tipe' => 'All New Jazz RS',
                'kapasitas_penumpang' => 8,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 375000.0,
                'price12' => 325000.0,
                'is_driver_allowed' => 1,
                'price_driver' => 475.0,
                'price_driver12' => 425.0,
                'photo' => '\\image\\tipe_armada\\ALL NEW JAZZ.png',
                'created_at' => '2021-04-17 15:58:07',
                'updated_at' => '2021-04-17 15:58:07',
            ),
            9 => 
            array (
                'id' => 18,
                'tipe' => 'Inova Reborn',
                'kapasitas_penumpang' => 10,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 450000.0,
                'price12' => NULL,
                'is_driver_allowed' => 1,
                'price_driver' => 700.0,
                'price_driver12' => NULL,
                'photo' => '\\image\\tipe_armada\\INNOVA REBORN.png',
                'created_at' => '2021-04-17 15:59:00',
                'updated_at' => '2021-04-17 15:59:00',
            ),
            10 => 
            array (
                'id' => 21,
                'tipe' => 'Kawasaki',
                'kapasitas_penumpang' => 10,
                'tipe_kemudi' => 'Automatic/Manual',
                'price' => 450000.0,
                'price12' => NULL,
                'is_driver_allowed' => 0,
                'price_driver' => 700.0,
                'price_driver12' => NULL,
                'photo' => '\\image\\tipe_armada\\INNOVA REBORN.png',
                'created_at' => '2021-04-17 15:59:00',
                'updated_at' => '2021-04-17 15:59:00',
            ),
        ));
        
        
    }
}