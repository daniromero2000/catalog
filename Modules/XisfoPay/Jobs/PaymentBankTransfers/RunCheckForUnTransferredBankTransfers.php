<?php

namespace Modules\XisfoPay\Jobs\PaymentBankTransfers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;

class RunCheckForUnTransferredBankTransfers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $paymentBankTransferInterface;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface)
    {
        $this->paymentBankTransferInterface = $paymentBankTransferRepositoryInterface;
        $this->paymentBankTransferInterface->notifyUnTransferredTransfers();
    }
}
