<?php

namespace Modules\XisfoPay\Listeners\PaymentBankTransfers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWereCreated;

class NotifyUsersOfNewPaymentBankTransfers implements ShouldQueue
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
     * @param  PaymentBankTransferWereCreated  $event
     * @return void
     */
    public function handle(PaymentBankTransferWereCreated $event)
    {
        $this->paymentBankTransferInterface->getCutPaymentBanktransfers($event->paymentCut);
    }
}
