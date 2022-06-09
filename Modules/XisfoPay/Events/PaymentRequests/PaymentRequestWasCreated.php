<?php

namespace Modules\XisfoPay\Events\PaymentRequests;

use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;

class PaymentRequestWasCreated
{
    use SerializesModels;

    public $paymentRequest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PaymentRequest $paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
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
