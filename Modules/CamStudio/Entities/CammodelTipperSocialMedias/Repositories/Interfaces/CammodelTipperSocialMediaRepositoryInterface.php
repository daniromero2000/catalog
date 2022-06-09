<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\CammodelTipperSocialMedia;


interface CammodelTipperSocialMediaRepositoryInterface
{
    public function createCammodelTipperSocialMedia(array $data): CammodelTipperSocialMedia;

    public function updateCammodelTipperSocialMedia(array $data): bool;

    public function findCammodelTipperSocialMediaById(int $CammodelTipperSocialMediaId): CammodelTipperSocialMedia;

    public function searchCammodelTipperSocialMedias(string $text = null): LengthAwarePaginator;
}
