<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelTippers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelTippers\Requests\CreateCammodelTipperRequest;
use Modules\CamStudio\Entities\CammodelTippers\Requests\UpdateCammodelTipperRequest;
use Modules\CamStudio\Entities\CammodelTippers\UseCases\Interfaces\CammodelTipperUseCaseInterface;

class CammodelTippersController extends Controller
{
    private $cammodelTipperServiceInterface;

    public function __construct(
        CammodelTipperUseCaseInterface $cammodelTipperUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_tippers, guard:employee']);
        $this->cammodelTipperServiceInterface = $cammodelTipperUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelTipperServiceInterface->listCammodelTippers(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-tippers.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-tippers.create', $this->cammodelTipperServiceInterface->createCammodelTipper());
    }

    public function store(CreateCammodelTipperRequest $request)
    {
        $this->cammodelTipperServiceInterface->storeCammodelTipper($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.create'));
    }

    public function show(int $CammodelTipperid): View
    {
        $response = $this->cammodelTipperServiceInterface->showCammodelTipper($CammodelTipperid);

        return view('camstudio::admin.cammodel-tippers.show', $response['data']);
    }

    public function update(UpdateCammodelTipperRequest $request, $CammodelTipperid)
    {
        $this->cammodelTipperServiceInterface->updateCammodelTipper($request, $CammodelTipperid);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $CammodelTipperid)
    {
        $this->cammodelTipperServiceInterface->destroyCammodelTipper($CammodelTipperid);

        return redirect()->route('admin.cammodel-tippers.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }
}
