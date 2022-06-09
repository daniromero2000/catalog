<?php

namespace Modules\CamStudio\Jobs\StreamingsApis;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;

class GetStreamingsApiData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $streamingStatsInterface, $cammodelStreamAccountsInterface;

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        StreamingStatRepositoryInterface $streamingStatRepositoryInterface,
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface
    ) {
        $this->streamingStatsInterface         = $streamingStatRepositoryInterface;
        $this->cammodelStreamAccountsInterface = $cammodelStreamAccountRepositoryInterface;
        $this->streamingStatsInterface->getStreamingsApiStats($this->cammodelStreamAccountsInterface->getCammodelsStreamAccounts('1'));
    }
}
