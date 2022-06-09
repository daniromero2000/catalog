<?php

namespace Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CammodelWorkReportCommentaryRepositoryInterface
{
    public function createCammodelWorkReportCommentary(array $data);

    public function findReportPeriodComments(array $periodDates, string $periodType): Collection;
}
