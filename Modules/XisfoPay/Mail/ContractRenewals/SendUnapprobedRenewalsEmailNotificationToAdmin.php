<?php

namespace Modules\XisfoPay\Mail\ContractRenewals;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendUnapprobedRenewalsEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $unApprobedRenewals;

    public function __construct(Collection $unApprobedRenewals)
    {
        $this->unApprobedRenewals = $unApprobedRenewals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Renovaciones de Contratos sin Aprobar')
            ->view('xisfopay::emails.admin.contract-renewals.unApprobedContractRenewalsNotificationEmail', ['datas' => $this->unApprobedRenewals]);
    }
}
