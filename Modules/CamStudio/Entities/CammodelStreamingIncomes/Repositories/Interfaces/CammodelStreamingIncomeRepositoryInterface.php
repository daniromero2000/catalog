<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;

interface CammodelStreamingIncomeRepositoryInterface
{
    public function createCammodelStreamingIncome(array $data): CammodelStreamingIncome;

    public function updateCammodelStreamingIncome(array $data): bool;

    public function findCammodelStreamingIncomeById(int $CammodelStreamingIncomeId): CammodelStreamingIncome;

    public function listCammodelStreamingIncomes($totalView): Collection;

    public function listAllCammodelStreamingIncomes(): Collection;

    public function listUnapprovedCammodelStreamingIncomes(): Collection;

    public function deleteCammodelStreamingIncome(): bool;

    public function searchCammodelStreamingIncome(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCammodelStreamingIncome(string $text = null,  $from = null, $to = null);

    public function getCammodelStreamingIncomes($streamAccountId, $periodDate, $createdAt);

    public function getAllNotAvailableWorkReportsIds(): array;

    public function getAllPeriodCammodelIncomes(array $dates, array $accountIds): Collection;

    public function getPeriodAprobedCammodelStreamingIncomes(array $dates, $subsidiaryId = null): Collection;

    public function getAprobedCammodelStreamingIncomesPeriod(array $dates): Collection;

    public function getAprobedSubsidiaryStreamingIncomesPeriod(array $dates, $accountIds): Collection;

    public function getPeriodAprobedSubsidiaryStreamingIncomes(array $dates, $accountIds, $subsidiaryId = null): Collection;

    public function getStreamAccountLastAvailableStreamingIncome($cammodelStreamAccountId, $to = null);

    public function getAprobedCammodelStreamingIncomesPeriodForDelete($accounts, array $dates): Collection;

    public function getPrevStreamingIncomes($today, $streamings);

    public function alreadyExists($streamAccount, $workReport);

    public function findFromStreamAccount(int $streamAccount, $from);

    public function getCammodelIncomesByDays($periodDate, array $streamAccounts): Collection;

    public function getManagerIncomesByDays($periodDate, int $managerId): Collection;

    public function getAllPeriodStreamingIncomes($periodDate, int $subsidiaryId = null, int $cammodelId = null): Collection;
}
