<?php

namespace Modules\CamStudio\Jobs\StreamingsApis;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces\CammodelStreamingIncomeUseCaseInterface;

class GetStreamingsIncomes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $cammodelStreamingIncomeServiceInterface;

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
    public function handle(CammodelStreamingIncomeUseCaseInterface $cammodelStreamingIncomeUseCaseInterface)
    {
        $this->cammodelStreamingIncomeServiceInterface = $cammodelStreamingIncomeUseCaseInterface;
        $this->cammodelStreamingIncomeServiceInterface->getApiStreamingIncomes();
    }
}
