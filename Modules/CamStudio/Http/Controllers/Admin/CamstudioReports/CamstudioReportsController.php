<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CamstudioReports;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CamstudioReports\UseCases\Interfaces\CamstudioReportUseCaseInterface;
use Modules\Companies\Entities\Employees\Exceptions\NoShiftAssignedException;

class CamstudioReportsController extends Controller
{
    private $camstudioReportServiceInterface;

    public function __construct(
        CamstudioReportUseCaseInterface $camstudioReportUseCaseInterface
    ) {
        $this->camstudioReportServiceInterface = $camstudioReportUseCaseInterface;
        $this->middleware(['permission:camstudio_reports, guard:employee']);
    }

    public function monthsReports(Request $request): View
    {
        $response = $this->camstudioReportServiceInterface->monthCamstudioClosingReport($request);
        return view('camstudio::admin.camstudio-reports.month_reports', $response['data']);
    }

    public function trimestersReports(Request $request): View
    {
        $response = $this->camstudioReportServiceInterface->trimesterCamstudioClosingReport($request);
        return view('camstudio::admin.camstudio-reports.trimester_reports', $response['data']);
    }

    public function managersReports(Request $request): View
    {
        $response = $this->camstudioReportServiceInterface->managersList($request);
        return view('camstudio::admin.camstudio-reports.manager_reports', $response['data']);
    }

    public function managerReport(Request $request, int $id): View
    {
        try {
            $response = $this->camstudioReportServiceInterface->managerReport($request, $id);
        } catch (NoShiftAssignedException $th) {
            return redirect()->route('admin.dashboard')->with('error', 'El manager no tiene turno asignado');
        }

        return view('camstudio::admin.camstudio-reports.manager_report', $response['data']);
    }
}
