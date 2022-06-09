<?php

namespace Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CamstudioReportCommentaryRepositoryInterface
{
    public function createCamstudioReportCommentary(array $data);

    public function findReportPeriodComments(array $periodDates, string $periodType, int $subsidiaryId = null): Collection;
}
