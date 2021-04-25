<?php

use Illuminate\Database\Seeder;

class ArmadasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('armadas')->delete();
        
        \DB::table('armadas')->insert(array (
            0 => 
            array (
                'id' => 17,
                'kode_armada' => 'Agya-1484',
                'id_tipe_armada' => 9,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:03:55',
                'updated_at' => '2021-04-17 17:03:55',
            ),
            1 => 
            array (
                'id' => 18,
                'kode_armada' => 'Agya-1239',
                'id_tipe_armada' => 9,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:04:03',
                'updated_at' => '2021-04-17 17:04:03',
            ),
            2 => 
            array (
                'id' => 19,
                'kode_armada' => 'Agya-9265',
                'id_tipe_armada' => 9,
                'status_armada' => 'not ready',
                'created_at' => '2021-04-17 17:04:10',
                'updated_at' => '2021-04-17 17:11:57',
            ),
            3 => 
            array (
                'id' => 20,
                'kode_armada' => 'Ayla-3218',
                'id_tipe_armada' => 10,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:05:17',
                'updated_at' => '2021-04-17 17:05:17',
            ),
            4 => 
            array (
                'id' => 21,
                'kode_armada' => 'Ayla-2728',
                'id_tipe_armada' => 10,
                'status_armada' => 'not ready',
                'created_at' => '2021-04-17 17:05:43',
                'updated_at' => '2021-04-17 17:05:43',
            ),
            5 => 
            array (
                'id' => 22,
                'kode_armada' => 'AllNewAgya-4727',
                'id_tipe_armada' => 11,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:05:52',
                'updated_at' => '2021-04-17 17:05:52',
            ),
            6 => 
            array (
                'id' => 23,
                'kode_armada' => 'NewBrio-4874',
                'id_tipe_armada' => 12,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:01',
                'updated_at' => '2021-04-17 17:06:01',
            ),
            7 => 
            array (
                'id' => 24,
                'kode_armada' => 'AllNewBrio-2654',
                'id_tipe_armada' => 13,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:09',
                'updated_at' => '2021-04-17 17:06:09',
            ),
            8 => 
            array (
                'id' => 25,
                'kode_armada' => 'Mobilio-3739',
                'id_tipe_armada' => 14,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:18',
                'updated_at' => '2021-04-17 17:06:18',
            ),
            9 => 
            array (
                'id' => 26,
                'kode_armada' => 'GrandNewAvanza-9141',
                'id_tipe_armada' => 15,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:26',
                'updated_at' => '2021-04-17 17:06:26',
            ),
            10 => 
            array (
                'id' => 27,
                'kode_armada' => 'JazzRS-4391',
                'id_tipe_armada' => 16,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:34',
                'updated_at' => '2021-04-17 17:06:34',
            ),
            11 => 
            array (
                'id' => 28,
                'kode_armada' => 'AllNewJazzRS-3417',
                'id_tipe_armada' => 17,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:06:43',
                'updated_at' => '2021-04-17 17:06:43',
            ),
            12 => 
            array (
                'id' => 29,
                'kode_armada' => 'InovaReborn-2192',
                'id_tipe_armada' => 18,
                'status_armada' => 'not ready',
                'created_at' => '2021-04-17 17:06:52',
                'updated_at' => '2021-04-17 17:06:52',
            ),
            13 => 
            array (
                'id' => 30,
                'kode_armada' => 'AllNewJazzRS-3496',
                'id_tipe_armada' => 17,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:07:04',
                'updated_at' => '2021-04-17 17:07:04',
            ),
            14 => 
            array (
                'id' => 31,
                'kode_armada' => 'Kawasaki-3496',
                'id_tipe_armada' => 21,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:07:04',
                'updated_at' => '2021-04-17 17:07:04',
            ),
            15 => 
            array (
                'id' => 32,
                'kode_armada' => 'Kawasaki-3497',
                'id_tipe_armada' => 21,
                'status_armada' => 'ready',
                'created_at' => '2021-04-17 17:07:04',
                'updated_at' => '2021-04-17 17:07:04',
            ),
        ));
        
        
    }
}