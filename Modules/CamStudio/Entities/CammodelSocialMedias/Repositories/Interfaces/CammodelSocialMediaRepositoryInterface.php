<?php

namespace Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelSocialMedias\CammodelSocialMedia;

interface CammodelSocialMediaRepositoryInterface
{
    public function createCammodelSocialMedia(array $data): CammodelSocialMedia;

    public function updateCammodelSocialMedia(array $data): bool;

    public function findCammodelSocialMediaById(int $CammodelSocialMediaId): CammodelSocialMedia;

    public function listCammodelSocialMedias(int $totalView): Collection;

    public function searchCammodelSocialMedias(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCammodelSocialMedias(string $text = null,  $from = null, $to = null);

    public function getCammodelsSocialMedia($socialPlatform = '3'): array;

    public function getCammodelsSocialMediaForCommand($socialPlatform = ['2', '3']);

    public function getCammodelTwitterAccountId(int $cammodelId);
}
