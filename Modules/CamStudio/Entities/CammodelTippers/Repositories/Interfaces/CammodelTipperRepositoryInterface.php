<?php

namespace Modules\CamStudio\Entities\CammodelTippers\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelTippers\CammodelTipper;

interface CammodelTipperRepositoryInterface
{
    public function createCammodelTipper(array $data): CammodelTipper;

    public function updateCammodelTipper(array $data): bool;

    public function findCammodelTipperById(int $CammodelTipperid): CammodelTipper;

    public function findCammodelTipperByParams(array $requestData);

    public function deleteCammodelTipper(): bool;

    public function searchCammodelTipper(string $text = null, $from = null, $to = null): LengthAwarePaginator;

    public function getCammodelTipperProfiles();
}
