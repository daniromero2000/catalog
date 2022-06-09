<?php

namespace Modules\XisfoPay\Listeners\ContractRequests\Front;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\ContractRequestRepository;
use Modules\XisfoPay\Events\ContractRequests\Front\ContractRequestFrontWasCreated;

class NotifyCustomerOfANewContractRequest implements ShouldQueue
{
    use InteractsWithQueue;

    public $contractRequest;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ContractRequest $contractRequest)
    {
        $this->contractRequest = $contractRequest;
    }

    /**
     * Handle the event.
     *
     * @param  ContractRequestWasCreated  $event
     * @return void
     */
    public function handle(ContractRequestFrontWasCreated $event)
    {
        // send email to customer
        $contractRequestRepo = new ContractRequestRepository($event->contractRequest);
        $contractRequestRepo->sendNewRequestRegisterToCostumer($event->link, $event->contractRequest);
    }
}
