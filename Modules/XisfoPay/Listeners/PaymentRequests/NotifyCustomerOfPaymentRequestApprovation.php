<?php

namespace Modules\XisfoPay\Listeners\PaymentRequests;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\PaymentRequestRepository;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasApproved;

class NotifyCustomerOfPaymentRequestApprovation implements ShouldQueue
{
    public $paymentRequest;

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 1;

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
     * @param  PaymentRequestWasApproved  $event
     * @return void
     */
    public function handle(PaymentRequestWasApproved $event)
    {
        // send email to customer
        $paymentRequestRepo = new PaymentRequestRepository($event->paymentRequest);
        $paymentRequestRepo->sendPaymentRequestApprovattionNotificationToCustomer();
    }
}
