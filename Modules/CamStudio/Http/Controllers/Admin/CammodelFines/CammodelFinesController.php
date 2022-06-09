<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelFines;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelFines\Requests\CreateCammodelFineRequest;
use Modules\CamStudio\Entities\CammodelFines\Requests\UpdateCammodelFineRequest;
use Modules\CamStudio\Entities\CammodelFines\UseCases\Interfaces\CammodelFineUseCaseInterface;
use Illuminate\Contracts\View\View;

class CammodelFinesController extends Controller
{
    private $cammodelFineServiceInterface;

    public function __construct(
        CammodelFineUseCaseInterface $cammodelFineUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_fines, guard:employee']);
        $this->cammodelFineServiceInterface = $cammodelFineUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelFineServiceInterface->listCammodelFines(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-fines.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-fines.create', $this->cammodelFineServiceInterface->createCammodelFine());
    }

    public function store(CreateCammodelFineRequest $request)
    {
        $this->cammodelFineServiceInterface->storeCammodelFine($request->except('_token', '_method'));
        return redirect()->route('admin.cammodel-fines.index')->with('message', config('messaging.create'));
    }

    public function show(int $cammodelFineId)
    {
        return redirect()->route('admin.cammodel-fines.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateCammodelFineRequest $request, int $cammodelFineId)
    {
        $this->cammodelFineServiceInterface->updateCammodelFine($request->except('_token', '_method'), $cammodelFineId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $cammodelFineId)
    {
        $this->cammodelFineServiceInterface->destroyCammodelFine($cammodelFineId);
        return back()->with('message', 'Eliminado Satisfactoriamente');
    }
}
