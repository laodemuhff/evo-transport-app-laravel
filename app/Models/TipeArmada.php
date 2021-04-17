<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeArmada extends Model
{
    protected $fillable = [
        'tipe',
        'tipe_kemudi',
        'kapasitas_penumpang'
    ];

    public function armada(){
        return $this->hasMany('App\Models\Armada', 'id_tipe_armada', 'id');
    }
}
