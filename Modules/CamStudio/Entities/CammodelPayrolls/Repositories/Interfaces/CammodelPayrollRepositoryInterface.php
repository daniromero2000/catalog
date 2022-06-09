<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelPayrolls\CammodelPayroll;

interface CammodelPayrollRepositoryInterface
{
    public function createCammodelPayroll(array $data): CammodelPayroll;

    public function updateCammodelPayroll(array $data): bool;

    public function findCammodelPayrollById(int $id): CammodelPayroll;

    public function listCammodelPayrolls($totalView): Collection;

    public function deleteCammodelPayroll(): bool;

    public function searchCammodelPayroll(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCammodelPayroll(string $text = null,  $from = null, $to = null);
}
