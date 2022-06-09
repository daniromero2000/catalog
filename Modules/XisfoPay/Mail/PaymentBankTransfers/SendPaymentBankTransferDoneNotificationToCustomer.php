<?php

namespace Modules\XisfoPay\Mail\PaymentBankTransfers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendPaymentBankTransferDoneNotificationToCustomer extends Mailable
{
    use Queueable, SerializesModels;
    private $cutPaymentBankTransfers;

    public function __construct($cutPaymentBankTransfers)
    {
        $this->cutPaymentBankTransfers = $cutPaymentBankTransfers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Transferencia bancaria aprobada')
            ->view('xisfopay::emails.admin.payment-bank-transfers.customerPaymentBankTransferNotificationEmail', ['data' => $this->cutPaymentBankTransfers]);
    }
}
