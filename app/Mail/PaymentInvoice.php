<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $prasyarat;
    protected $transaction;

    public function __construct($prasyarat, $transaction)
    {
        $this->prasyarat = $prasyarat;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('Payment Invoice '.$this->transaction['nomor_faktur'])
                    ->markdown('emails.invoice.payment')->with([
            'prasyarat' => $this->prasyarat,
            'transaction' => $this->transaction
        ]);
    }
}
