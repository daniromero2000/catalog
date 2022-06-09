<?php

namespace Modules\XisfoPay\Mail\Contracts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendInActiveContractsEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    private $inActiveContracts;

    public function __construct(Collection $inActiveContracts)
    {
        $this->inActiveContracts = $inActiveContracts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contratos Inactivos')
            ->view('xisfopay::emails.admin.contracts.inActiveContractsNotificationEmail', ['datas' => $this->inActiveContracts]);
    }
}
