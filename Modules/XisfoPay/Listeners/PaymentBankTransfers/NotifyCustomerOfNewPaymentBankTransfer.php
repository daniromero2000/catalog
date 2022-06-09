<?php

namespace Modules\XisfoPay\Listeners\PaymentBankTransfers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;

class NotifyCustomerOfNewPaymentBankTransfer implements ShouldQueue
{
    private $paymentBankTransferInterface;

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 1;

    public function __construct(
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface
    ) {
        $this->paymentBankTransferInterface = $paymentBankTransferRepositoryInterface;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->paymentBankTransferInterface->sendCustomerPaymentBankTransfersEmailNotification($event->paymentRequestId);
    }
}
