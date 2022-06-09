<?php

namespace Modules\XisfoPay\Listeners\PaymentBankTransfers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWasCreated;

class NotifyUsersOfNewPaymentBankTransfer implements ShouldQueue
{
    private $paymentBankTransferInterface;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface
    ) {
        $this->paymentBankTransferInterface = $paymentBankTransferRepositoryInterface;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentBankTransferWasCreated  $event
     * @return void
     */
    public function handle(PaymentBankTransferWasCreated $event)
    {
        $this->paymentBankTransferInterface->sendPaymentBankTransferToAdmin($event->paymentBankTransfer);
    }
}
