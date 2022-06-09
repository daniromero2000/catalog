<?php

namespace Modules\XisfoPay\Events\PaymentBankTransfers;

use Illuminate\Queue\SerializesModels;

class PaymentBankTransferDone
{
    use SerializesModels;

    public $paymentRequestId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($paymentBankTransfer)
    {
        $this->paymentRequestId = $paymentBankTransfer->id;
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
