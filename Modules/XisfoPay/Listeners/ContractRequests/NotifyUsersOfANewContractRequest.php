<?php

namespace Modules\XisfoPay\Listeners\ContractRequests;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\ContractRequestRepository;
use Modules\XisfoPay\Events\ContractRequests\ContractRequestWasCreated;

class NotifyUsersOfANewContractRequest implements ShouldQueue
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
    public function handle(ContractRequestWasCreated $event)
    {
        // send email to customer
        $contractRequestRepo = new ContractRequestRepository($event->contractRequest);
        $contractRequestRepo->sendNewRequestEmailNotificationToAdmin();
    }
}
