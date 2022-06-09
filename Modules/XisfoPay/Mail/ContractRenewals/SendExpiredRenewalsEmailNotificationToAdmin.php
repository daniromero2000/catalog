<?php

namespace Modules\XisfoPay\Mail\ContractRenewals;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendExpiredRenewalsEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $expiredRenewals;

    public function __construct(Collection $expiredRenewals)
    {
        $this->expiredRenewals = $expiredRenewals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Renovaciones de contrato expiradas')
            ->view('xisfopay::emails.admin.contract-renewals.expiredContractRenewalsNotificationEmail', ['datas' => $this->expiredRenewals]);
    }
}
