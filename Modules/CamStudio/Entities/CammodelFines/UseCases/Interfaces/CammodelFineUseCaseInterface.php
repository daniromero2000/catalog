<?php

namespace Modules\CamStudio\Entities\CammodelFines\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelFines\CammodelFine;

interface CammodelFineUseCaseInterface
{
    public function listCammodelFines(array $data): array;

    public function createCammodelFine(): array;

    public function storeCammodelFine(array $requestData): CammodelFine;

    public function updateCammodelFine(array $requestData, int $cammodelFineId): void;

    public function destroyCammodelFine(int $cammodelFineId): void;

    public function getAllNotAvailableFouls(): array;
}
