<?php

namespace Modules\XisfoPay\Events\PaymentRequestAdvances;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;

class PaymentRequestAdvanceCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $paymentRequestAdvance;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PaymentRequestAdvance $paymentRequestAdvance)
    {
        $this->paymentRequestAdvance = $paymentRequestAdvance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
