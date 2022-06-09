<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelWorkReports\CammodelWorkReport;

interface CammodelWorkReportRepositoryInterface
{
    public function createCammodelWorkReport(array $data): CammodelWorkReport;

    public function updateCammodelWorkReport(array $data): bool;

    public function findCammodelWorkReportById(int $CammodelWorkReportId): CammodelWorkReport;

    public function findCammodelLastWorkReportById(int $cammodelId): CammodelWorkReport;

    public function searchCammodelWorkReportsWithIncomes(string $text = null, $from = null, $to = null, array $where): LengthAwarePaginator;

    public function searchSubsidiaryCammodelWorkReportsWithIncomes(string $text = null, int $subsidiary_id, $from = null, $to = null, array $where): LengthAwarePaginator;

    public function deleteCammodelWorkReport(): bool;

    public function searchCammodelWorkReport(string $text = null, $from = null, $to = null, $comments = null, int $subsidiary_id = null): LengthAwarePaginator;

    public function getAllCammodelWorkReports(): Collection;

    public function getAllNotAvailableRoomsIds(): Collection;

    public function getNotAvailableCammodelsIds(): Collection;
}
