<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelWorkReports\CammodelWorkReport;

interface CammodelWorkReportUseCaseInterface
{
    public function listCammodelWorkReports(array $data): array;

    public function createCammodelWorkReport(): array;

    public function storeCammodelWorkReport(array $requestData): CammodelWorkReport;

    public function updateCammodelWorkReport(array $requestData, int $CammodelWorkReportId);

    public function destroyCammodelWorkReport(int $CammodelWorkReportId);
}
