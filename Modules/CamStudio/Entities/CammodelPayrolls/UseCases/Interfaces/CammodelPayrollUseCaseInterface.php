<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CammodelPayrollUseCaseInterface
{
    public function listCammodelPayrolls(array $data): array;

    public function createCammodelPayroll();

    public function storeCammodelPayroll(array $requestData);

    public function showCammodelPayroll(int $id);

    public function updateCammodelPayroll(array $request, int $id);

    public function destroyCammodelPayroll(int $id);

    public function getCammodelsLiquidations($dates = null);

    public function getPeriodCammodelsLiquidations($dates = null, array $filtersData);

    public function getCammodelLiquidations(int $cammodelId);

    public function getCammodelPastLiquidations(int $cammodelId);

    public function getAllPeriodCammodelIncomes(array $accountIds, array $dates): Collection;
    
}
