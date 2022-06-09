<?php

namespace Modules\CamStudio\Entities\CammodelTippers\UseCases\Interfaces;

interface CammodelTipperUseCaseInterface
{
    public function listCammodelTippers(array $data): array;

    public function showCammodelTipper(int $id): array;

    public function createCammodelTipper(): array;

    public function storeCammodelTipper(array $requestData);

    public function updateCammodelTipper($request, int $id);

    public function destroyCammodelTipper(int $id);
}
