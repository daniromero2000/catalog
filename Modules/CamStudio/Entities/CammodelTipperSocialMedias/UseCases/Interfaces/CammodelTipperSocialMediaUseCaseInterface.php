<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelTipperSocialMedias\CammodelTipperSocialMedia;

interface CammodelTipperSocialMediaUseCaseInterface
{
    public function listCammodelTipperSocialMedias(array $data): array;

    public function createCammodelTipperSocialMedia(): array;

    public function storeCammodelTipperSocialMedia(array $requestData): CammodelTipperSocialMedia;

    public function updateCammodelTipperSocialMedia($request, int $id): bool;

    public function destroyCammodelTipperSocialMedia(int $id): bool;
}
