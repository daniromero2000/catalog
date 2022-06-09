<?php

namespace Modules\XisfoPay\Events\PaymentBankTransfers;

use Illuminate\Queue\SerializesModels;

class PaymentBankTransferWasCreated
{
    use SerializesModels;

    public $paymentBankTransfer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($paymentBankTransfer)
    {
        $this->paymentBankTransfer = $paymentBankTransfer;
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
