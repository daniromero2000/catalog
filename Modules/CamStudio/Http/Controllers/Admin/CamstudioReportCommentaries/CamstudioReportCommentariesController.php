<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CamstudioReportCommentaries;

use Modules\CamStudio\Entities\CamstudioReportCommentaries\Requests\CreateCamstudioReportCommentaryRequest;
use App\Http\Controllers\Controller;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\Interfaces\CamstudioReportCommentaryUseCaseInterface;

class CamstudioReportCommentariesController extends Controller
{
    private $camstudioReportCommentaryServiceInterface;

    public function __construct(
        CamstudioReportCommentaryUseCaseInterface $camstudioReportCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:camstudio_reports, guard:employee']);
        $this->camstudioReportCommentaryServiceInterface = $camstudioReportCommentaryUseCaseInterface;
    }

    public function store(CreateCamstudioReportCommentaryRequest $request)
    {
        $this->camstudioReportCommentaryServiceInterface->storeCamstudioReportCommentary($request->except('_token', '_method'));
        $request->session()->flash('message', 'Comentario Creado Exitosamente');
        return back();
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
