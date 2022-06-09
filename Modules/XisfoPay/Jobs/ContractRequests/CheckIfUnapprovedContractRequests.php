<?php

namespace Modules\XisfoPay\Jobs\ContractRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces\ContractRequestUseCaseInterface;

class CheckIfUnapprovedContractRequests implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $contractRequestInterface;

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
    public function handle(ContractRequestUseCaseInterface $contractRequestUseCaseInterface)
    {
        $this->contractRequestInterface = $contractRequestUseCaseInterface;
        $this->contractRequestInterface->checkIfUnapprobedRequests();
    }
}
