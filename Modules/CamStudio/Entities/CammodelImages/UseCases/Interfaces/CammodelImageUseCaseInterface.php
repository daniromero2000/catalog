<?php

namespace Modules\CamStudio\Entities\CammodelImages\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelImages\CammodelImage;

interface CammodelImageUseCaseInterface
{
    public function listCammodelImages(array $data): array;

    public function storeCammodelImage(array $requestData): CammodelImage;
}
