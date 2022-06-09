<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\UseCases\Interfaces;

interface CammodelBannedCountryUseCaseInterface
{
    public function listCammodelBannedCountries(array $data): array;

    public function storeCammodelBannedCountry(array $requestData): void;
}
