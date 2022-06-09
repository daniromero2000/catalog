<?php

namespace Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces;

use Modules\CamStudio\Entities\Cammodels\Cammodel;

interface CammodelUseCaseInterface
{
    public function listCammodels(array $data): array;

    public function listInactiveCammodels(array $data): array;

    public function createCammodel(): array;

    public function storeCammodel(array $requestData): Cammodel;

    public function showCammodel(int $cammodelId): array;

    public function updateCammodel($request, int $cammodelId): bool;

    public function destroyCammodel(int $cammodelId): bool;

    public function removeCamModelThumbnail(string $src);

    public function getCammodelProfile(): int;

    public function deactivateCammodel(int $cammodelId, int $activate);

    public function getCammodelNames(array $filterData);

    public function setCammodelTippers($tippers, int $cammodelId);
}
