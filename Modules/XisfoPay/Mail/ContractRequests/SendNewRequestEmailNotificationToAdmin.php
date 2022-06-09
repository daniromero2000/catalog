<?php

namespace Modules\XisfoPay\Mail\ContractRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

class SendNewRequestEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $contractRequest;

    public function __construct(ContractRequest $contractRequest)
    {
        $this->contractRequest = $contractRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'contractRequest' => $this->contractRequest
        ];

        return $this->subject('Nueva Solicitud de Contrato')
            ->view('xisfopay::emails.admin.contract-requests.newContractRequestNotificationEmail', $data);
    }
}
