<?php

namespace Modules\XisfoPay\Mail\PaymentBankTransfers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendUnApprovedBankTransfersEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $unApprovedBankTransfers;

    public function __construct(Collection $unApprovedBankTransfers)
    {
        $this->unApprovedBankTransfers = $unApprovedBankTransfers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Transferencias Bancarias sin realizar')
            ->view('xisfopay::emails.admin.payment-bank-transfers.unApprovedBankTransfersNotificationEmail', ['datas' => $this->unApprovedBankTransfers]);
    }
}
