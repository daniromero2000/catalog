<?php

namespace Modules\XisfoPay\Mail\ContractRequests\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

class SendNewRequestEmailNotificationCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $contractRequest, $link;

    public function __construct(ContractRequest $contractRequest, $link)
    {
        $this->contractRequest = $contractRequest;
        $this-> link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'contractRequest'   => $this->contractRequest,
            'link'              => $this->link
        ];

        return $this->subject('Confirmación de creación de cuenta')
            ->view('xisfopay::emails.admin.contract-requests.Front.newContractRequestNotificationCustomerEmail', $data);
    }
}
