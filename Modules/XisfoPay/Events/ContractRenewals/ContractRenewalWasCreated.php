<?php

namespace Modules\XisfoPay\Events\ContractRenewals;

use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;

class ContractRenewalWasCreated
{
    use SerializesModels;

    public $contractRenewal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContractRenewal $contractRenewal)
    {
        $this->contractRenewal = $contractRenewal;
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
