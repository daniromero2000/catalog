<?php

namespace Modules\XisfoPay\Events\PaymentCuts;

use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;

class PaymentCutWasCreated
{
    use SerializesModels;

    public $paymentCut;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PaymentCut $paymentCut)
    {
        $this->paymentCut = $paymentCut;
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
