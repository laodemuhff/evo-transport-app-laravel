<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $fillable = [
        'nomor_faktur',
        'nama_customer',
        'alamat_customer',
        'no_hp_customer',
        'id_armada',
        'id_driver',
        'durasi_sewa',
        'pickup_date',
        'return_date',
        'customer_return_date',
        'note',
        'status_lepas_kunci',
        'status_pengambilan',
        'status_transaksi',
        'is_deleted',
        'is_cancelled',
        'cancelled_reason',
        'cancelled_by',
        'grand_total'
    ];

    protected $appends = [
        'expired_at',
        'schedule_status'
    ];

    public function armada(){
        return $this->belongsTo('App\Models\Armada', 'id_armada', 'id');
    }

    public function getExpiredAtAttribute(){
        if($this->status_transaksi == 'pending')
            return date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($this->created_at)));
        else
            return null;
    }

    public function driver(){
        return $this->belongsTo(Driver::class, 'id_driver', 'id');
    }

    public function getScheduleStatusAttribute(){
        $expire_date = Self::getExpiredAtAttribute();
        if($expire_date !== null && strtotime($expire_date) < strtotime(date('Y-m-d H:i:s'))){
            return 'expired';

        }elseif($expire_date !== null && strtotime($expire_date) >= strtotime(date('Y-m-d H:i:s'))){
            return 'waiting confirmation';

        }elseif($this->status_transaksi == 'on rent' && strtotime($this->return_date) < strtotime(date('Y-m-d H:i:s'))){
            return 'late return';

        }elseif($this->status_transaksi == 'on rent' && strtotime($this->return_date) >= strtotime(date('Y-m-d H:i:s'))){
            return 'on progress';

        }else{
            return 'returned';
        }
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
