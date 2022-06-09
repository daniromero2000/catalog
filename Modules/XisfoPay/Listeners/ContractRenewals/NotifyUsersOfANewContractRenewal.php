<?php

namespace Modules\XisfoPay\Listeners\ContractRenewals;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\ContractRenewalRepository;
use Modules\XisfoPay\Events\ContractRenewals\ContractRenewalWasCreated;

class NotifyUsersOfANewContractRenewal implements ShouldQueue
{
    use InteractsWithQueue;

    public $contractRenewal;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ContractRenewal $contractRenewal)
    {
        $this->contractRenewal = $contractRenewal;
    }

    /**
     * Handle the event.
     *
     * @param  ContractRenewalWasCreated  $event
     * @return void
     */
    public function handle(ContractRenewalWasCreated $event)
    {
        // send email to customer
        $contractRenewalRepo = new ContractRenewalRepository($event->contractRenewal);
        $contractRenewalRepo->sendNewRenewalEmailNotificationToAdmin();
    }
}
