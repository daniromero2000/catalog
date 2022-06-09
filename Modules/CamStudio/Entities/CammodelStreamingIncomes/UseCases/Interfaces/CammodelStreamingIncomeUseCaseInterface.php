<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;

interface CammodelStreamingIncomeUseCaseInterface
{
    public function listCammodelStreamingIncomes(array $data): array;

    public function createCammodelStreamingIncome(): array;

    public function createOfflineCammodelStreamingIncome(): array;

    public function storeCammodelStreamingIncome(array $requestData);

    public function storeOfflineCammodelStreamingIncome(array $requestData);

    public function updateCammodelStreamingIncome($request, int $id, $assistant = null);

    public function updateWorkReportStreamingIncomes($request);

    public function destroyCammodelStreamingIncome(int $id): bool;

    public function getApiStreamingIncomes();
}
