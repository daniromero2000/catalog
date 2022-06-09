<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelWorkReports;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelWorkReports\Requests\CreateCammodelWorkReportRequest;
use Modules\CamStudio\Entities\CammodelWorkReports\Requests\UpdateCammodelWorkReportRequest;
use Modules\CamStudio\Entities\CammodelWorkReports\UseCases\Interfaces\CammodelWorkReportUseCaseInterface;

class CammodelWorkReportsController extends Controller
{
    private $cammodelWorkReportServiceInterface;

    public function __construct(
        CammodelWorkReportUseCaseInterface $cammodelWorkReportUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_streaming_incomes|cammodel_work_reports, guard:employee']);
        $this->cammodelWorkReportServiceInterface = $cammodelWorkReportUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelWorkReportServiceInterface->listCammodelWorkReports(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-work-reports.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-work-reports.create', $this->cammodelWorkReportServiceInterface->createCammodelWorkReport());
    }

    public function store(CreateCammodelWorkReportRequest $request)
    {
        $this->cammodelWorkReportServiceInterface->storeCammodelWorkReport($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-streaming-incomes.create')
            ->with('message', config('messaging.create'));
    }

    public function show(int $CammodelWorkReportId)
    {
        return redirect()->route('admin.cammodel-streaming-incomes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateCammodelWorkReportRequest $request, $CammodelWorkReportId)
    {
        $this->cammodelWorkReportServiceInterface->updateCammodelWorkReport($request->except('_token', '_method'), $CammodelWorkReportId);

        return redirect()->route('admin.cammodel-streaming-incomes.create')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $CammodelWorkReportId)
    {
        $this->cammodelWorkReportServiceInterface->destroyCammodelWorkReport($CammodelWorkReportId);

        return redirect()->route('admin.cammodel-work-reports.index')
            ->with('message', config('messaging.delete'));
    }
}
