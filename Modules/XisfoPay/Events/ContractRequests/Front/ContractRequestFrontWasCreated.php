<?php

namespace Modules\XisfoPay\Events\ContractRequests\Front;

use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

class ContractRequestFrontWasCreated
{
    use SerializesModels;

    public $contractRequest, $link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContractRequest $contractRequest, $link)
    {
        $this->contractRequest = $contractRequest;
        $this->link = $link;
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
