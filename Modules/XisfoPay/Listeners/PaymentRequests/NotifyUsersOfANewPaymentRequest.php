<?php

namespace Modules\XisfoPay\Listeners\PaymentRequests;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\PaymentRequestRepository;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasCreated;

class NotifyUsersOfANewPaymentRequest implements ShouldQueue
{
    public $paymentRequest;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaymentRequest $paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentRequestWasCreated  $event
     * @return void
     */
    public function handle(PaymentRequestWasCreated $event)
    {
        // send email to customer
        $paymentRequestRepo = new PaymentRequestRepository($event->paymentRequest);
        $paymentRequestRepo->sendNewPaymentRequestEmailNotificationToAdmin();
    }
}
