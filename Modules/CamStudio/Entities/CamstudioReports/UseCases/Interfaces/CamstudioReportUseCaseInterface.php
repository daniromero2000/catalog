<?php

namespace Modules\CamStudio\Entities\CamstudioReports\UseCases\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CamstudioReportUseCaseInterface
{
    public function monthCamstudioClosingReport(Request $request);
    
    public function trimesterCamstudioClosingReport(Request $request);

    public function managersList(Request $request);

    public function managerReport(Request $request, int $managerId);

}
