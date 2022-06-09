<?php

namespace Modules\CamStudio\Entities\CammodelStats\UseCases\Interfaces;

interface CammodelStatUseCaseInterface
{
    public function listCammodelStats(): array;

    public function showCammodelStats(int $id): array;
}
