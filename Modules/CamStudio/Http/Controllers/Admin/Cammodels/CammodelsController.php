<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Cammodels;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Cammodels\Requests\CreateCammodelRequest;
use Modules\CamStudio\Entities\Cammodels\Requests\UpdateCammodelRequest;
use Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces\CammodelUseCaseInterface;

class CammodelsController extends Controller
{
    private $cammodelServiceInterface;

    public function __construct(
        CammodelUseCaseInterface $cammodelUseCaseInterface
    ) {
        $this->middleware(['permission:cam_models, guard:employee']);
        $this->middleware('CammodelSubsidiaryIsOwner', ['only' => ['show']]);
        $this->cammodelServiceInterface = $cammodelUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelServiceInterface->listCammodels(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodels.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodels.create', $this->cammodelServiceInterface->createCammodel());
    }

    public function store(CreateCammodelRequest $request)
    {
        $cammodel = $this->cammodelServiceInterface->storeCammodel($request->except('_token', '_method'));

        return redirect()->route('admin.cammodels.show', $cammodel->id);
    }

    public function show(int $cammodelid): View
    {
        return view('camstudio::admin.cammodels.show', $this->cammodelServiceInterface->showCammodel($cammodelid));
    }

    public function edit(int $cammodelid)
    {
        return redirect()->route('admin.cammodels.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateCammodelRequest $request, int $cammodelid)
    {
        $this->cammodelServiceInterface->updateCammodel($request, $cammodelid);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $cammodelid)
    {
        $this->cammodelServiceInterface->destroyCammodel($cammodelid);
        return back()->with('message', config('messaging.delete'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->cammodelServiceInterface->removeCamModelThumbnail($request->src);
        return back()->with('message', config('messaging.delete'));
    }

    public function getProfile()
    {
        return $this->show($this->cammodelServiceInterface->getCammodelProfile());
    }

    public function deactivate(int $cammodelid)
    {
        $this->cammodelServiceInterface->deactivateCammodel($cammodelid, 0);
        return redirect()->route('admin.cammodels.index')
            ->with('message', 'Modelo Desactivada Satisfactoriamente');
    }

    public function activate(int $cammodelid)
    {
        $this->cammodelServiceInterface->deactivateCammodel($cammodelid, 1);
        return redirect()->route('admin.cammodels.index')
            ->with('message', 'Modelo Activada Satisfactoriamente');
    }

    public function inactiveCammodelsList(Request $request)
    {
        $response = $this->cammodelServiceInterface->listInactiveCammodels(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodels.list-inactive', $response['data']);
    }
}
