<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Armada;

class TransactionObserver
{
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "updated" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "deleted" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "restored" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "force deleted" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }

    public function retrieved(Transaction $transaction)
    {
        if($transaction->status_transaksi == 'pending' && strtotime(date('Y-m-d H:i:s')) >= strtotime($transaction->expired_at)){
            Transaction::where('id', $transaction->id)->update([
                'status_transaksi' => 'cancelled',
                'cancelled_reason' => 'expired',
                'cancelled_by' => 'system'
            ]);

            $id_armada =  Transaction::where('id', $transaction->id)->first()['id_armada'];

            Armada::where('id', $id_armada)->update([
                'status_armada' => 'ready'
            ]);
        }
    }
}
