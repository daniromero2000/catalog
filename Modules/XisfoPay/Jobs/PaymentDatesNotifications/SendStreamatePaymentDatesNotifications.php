<?php

namespace Modules\XisfoPay\Jobs\PaymentDatesNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\Interfaces\ContractRequestStreamAccountUseCaseInterface;

class SendStreamatePaymentDatesNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contractRequestStreamAccountServiceInterface;
     /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ContractRequestStreamAccountUseCaseInterface $contractRequestStreamAccountUseCaseInterface)
    {
        $this->contractRequestStreamAccountServiceInterface = $contractRequestStreamAccountUseCaseInterface;
        $this->contractRequestStreamAccountServiceInterface->sendPaymentDatesNotifications([8]);
    }
}
