<?php

namespace Modules\XisfoPay\Events\PaymentBankTransfers;

use Illuminate\Queue\SerializesModels;

class PaymentBankTransferWereCreated
{
    use SerializesModels;

    public $paymentCut;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($paymentCut)
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
