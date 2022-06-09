<?php

namespace Modules\XisfoPay\Listeners\PaymentRequestAdvances;

use Modules\XisfoPay\Events\PaymentRequestAdvances\PaymentRequestAdvanceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;

class SendNewPaymentRequestAdvanceNotification implements ShouldQueue
{
    private $paymentRequestAdvanceServiceInterface;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaymentRequestAdvanceUseCaseInterface $paymentRequestAdvanceUseCaseInterface)
    {
        $this->paymentRequestAdvanceServiceInterface = $paymentRequestAdvanceUseCaseInterface;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentRequestAdvanceCreated  $event
     * @return void
     */
    public function handle(PaymentRequestAdvanceCreated $event)
    {
        $this->paymentRequestAdvanceServiceInterface->sendNewPaymentRequestAdvanceEmailNotificationToAdmin($event->paymentRequestAdvance);
    }
}
