<?php

namespace Modules\XisfoPay\Jobs\Contracts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;

class CheckIfInactiveContracts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contractInterface;

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
    public function handle(ContractRepositoryInterface $contractRepositoryInterface)
    {
        $this->contractInterface = $contractRepositoryInterface;
        $this->contractInterface->checkIfInActiveContracts();
    }
}
