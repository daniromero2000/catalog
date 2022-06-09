<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelWorkReportCommentaries;

use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Requests\CreateCammodelWorkReportCommentaryRequest;
use App\Http\Controllers\Controller;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases\Interfaces\CammodelWorkReportCommentaryUseCaseInterface;

class CammodelWorkReportCommentariesController extends Controller
{
    private $cammodelWorkReportCommentaryServiceInterface;

    public function __construct(
        CammodelWorkReportCommentaryUseCaseInterface $cammodelWorkReportCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_work_reports|cammodel_streaming_incomes, guard:employee']);
        $this->cammodelWorkReportCommentaryServiceInterface = $cammodelWorkReportCommentaryUseCaseInterface;
    }

    public function store(CreateCammodelWorkReportCommentaryRequest $request)
    {
        $this->cammodelWorkReportCommentaryServiceInterface->storeCammodelWorkReportCommentary($request->except('_token', '_method'));
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $CammodelWorkReportCommentaryId)
    {
        return redirect()->route('admin.dashboard')->with('error', config('messaging.not_found'));
    }
}
