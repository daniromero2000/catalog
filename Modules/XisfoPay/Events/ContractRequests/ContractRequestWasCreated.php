<?php

namespace Modules\XisfoPay\Events\ContractRequests;

use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

class ContractRequestWasCreated
{
    use SerializesModels;

    public $contractRequest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContractRequest $contractRequest)
    {
        $this->contractRequest = $contractRequest;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
