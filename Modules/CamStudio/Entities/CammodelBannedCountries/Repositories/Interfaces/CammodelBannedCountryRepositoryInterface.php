<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;

interface CammodelBannedCountryRepositoryInterface
{
    public function createCammodelBannedCountry(array $data): CammodelBannedCountry;

    public function searchCammodelBannedCountries(string $text = null, int $subsidiaryId = null): LengthAwarePaginator;
}
