<?php

namespace Modules\XisfoPay\Mail\ContractRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendUnapprobedRequestsEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $unApprobedRequests;

    public function __construct(Collection $unApprobedRequests)
    {
        $this->unApprobedRequests = $unApprobedRequests;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Solicitudes de Contratos sin Aprobar')
            ->view('xisfopay::emails.admin.contract-requests.unApprobedContractRequestsNotificationEmail', ['datas' => $this->unApprobedRequests]);
    }
}
