<?php

namespace Modules\XisfoPay\Mail\ContractRenewals;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;

class SendNewRenewalEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $contractRenewal;

    public function __construct(ContractRenewal $contractRenewal)
    {
        $this->contractRenewal = $contractRenewal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'contractRenewal'    => $this->contractRenewal
        ];

        return $this->subject('Nueva renovación de contrato')
            ->view('xisfopay::emails.admin.contract-renewals.newContractRenewalNotificationEmail', $data);
    }
}
