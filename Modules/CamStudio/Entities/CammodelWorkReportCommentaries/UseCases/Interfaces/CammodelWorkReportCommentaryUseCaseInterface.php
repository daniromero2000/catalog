<?php

namespace Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases\Interfaces;

use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\CammodelWorkReportCommentary;

interface CammodelWorkReportCommentaryUseCaseInterface
{

    public function storeCammodelWorkReportCommentary(array $requestData): CammodelWorkReportCommentary;
}
