<?php

namespace Modules\XisfoPay\Listeners\PaymentCuts;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\PaymentCutRepository;
use Modules\XisfoPay\Events\PaymentCuts\PaymentCutWasCreated;

class NotifyUsersOfANewPaymentCut implements ShouldQueue
{
    use InteractsWithQueue;

    public $paymentCut;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaymentCut $paymentCut)
    {
        $this->paymentCut = $paymentCut;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentCutWasCreated  $event
     * @return void
     */
    public function handle(PaymentCutWasCreated $event)
    {
        // send email to customer
        $paymentCutRepo = new PaymentCutRepository($event->paymentCut);
        $paymentCutRepo->sendNewPaymentCutEmailNotificationToAdmin();
    }
}
