<?php

namespace Modules\XisfoPay\Mail\PaymentBankTransfers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendCutPaymentBankTransfersEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $paymentBankTransfers;

    public function __construct($paymentBankTransfers)
    {
        $this->paymentBankTransfers = $paymentBankTransfers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nuevas Transferencias Bancarias Aprobadas')
            ->view('xisfopay::emails.admin.payment-bank-transfers.cutPaymentBankTransfersNotificationEmail', ['datas' => $this->paymentBankTransfers]);
    }
}
