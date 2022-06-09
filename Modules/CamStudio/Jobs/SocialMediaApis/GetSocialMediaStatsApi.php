<?php

namespace Modules\CamStudio\Jobs\SocialMediaApis;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;

class GetSocialMediaStatsApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $socialStatsInterface, $cammodelSocialMediaInterface;

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
    public function handle(
        SocialStatRepositoryInterface $socialStatRepositoryInterface,
        CammodelSocialMediaRepositoryInterface $cammodelSocialMediaRepositoryInterface
    ) {
        $this->socialStatsInterface         = $socialStatRepositoryInterface;
        $this->cammodelSocialMediaInterface = $cammodelSocialMediaRepositoryInterface;
        $this->socialStatsInterface->getSocialApiStats($this->cammodelSocialMediaInterface->getCammodelsSocialMediaForCommand());
    }
}
