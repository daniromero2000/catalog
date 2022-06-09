<?php

namespace Modules\XisfoPay\Jobs\ContractRenewals;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\Interfaces\ContractRenewalRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;

class CheckIfUnapprovedContractRenewals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contractRenewalServiceInterface;

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
    public function handle(ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface)
    {
        $this->contractRenewalServiceInterface = $contractRenewalUseCaseInterface;
        $this->contractRenewalServiceInterface->checkIfUnapprobedRenewals();
    }
}
