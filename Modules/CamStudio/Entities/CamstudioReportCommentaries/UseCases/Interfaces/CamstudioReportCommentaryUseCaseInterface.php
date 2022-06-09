<?php

namespace Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\Interfaces;

use Modules\CamStudio\Entities\CamstudioReportCommentaries\CamstudioReportCommentary;

interface CamstudioReportCommentaryUseCaseInterface
{
    public function storeCamstudioReportCommentary(array $requestData): CamstudioReportCommentary;

    public function listCamstudioReportCommentaries(array $periodDates, string $periodType);
}
