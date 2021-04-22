<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TipeArmada extends Model
{
    protected $fillable = [
        'tipe',
        'tipe_kemudi',
        'kapasitas_penumpang',
        'status_driver',
        'price',
        'price12',
        'is_driver_allowed',
        'price_driver',
        'price_driver12',
        'photo'
    ];

    public function armada(){
        return $this->hasMany('App\Models\Armada', 'id_tipe_armada', 'id');
    }

    public static function getEnumValues($column){
        // Create an instance of the model to be able to get the table name
        $instance = new static;

        $arr = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$column.'"'));
        if (count($arr) == 0){
            return array();
        }
        // Pulls column string from DB
        $enumStr = $arr[0]->Type;

        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);

        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }
}
