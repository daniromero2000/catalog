<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelStreamingIncomes;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Requests\CreateCammodelStreamingIncomeRequest;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Requests\UpdateCammodelStreamingIncomeRequest;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces\CammodelStreamingIncomeUseCaseInterface;

class CammodelStreamingIncomesController extends Controller
{
    private $cammodelStreamingIncomeServiceInterface;

    public function __construct(
        CammodelStreamingIncomeUseCaseInterface $cammodelStreamingIncomeUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_streaming_incomes|cam_models, guard:employee']);
        $this->cammodelStreamingIncomeServiceInterface = $cammodelStreamingIncomeUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelStreamingIncomeServiceInterface->listCammodelStreamingIncomes(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-streaming-incomes.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-streaming-incomes.create', $this->cammodelStreamingIncomeServiceInterface->createCammodelStreamingIncome());
    }

    public function createOffline(): View
    {
        return view('camstudio::admin.cammodel-streaming-incomes.create_offline', $this->cammodelStreamingIncomeServiceInterface->createOfflineCammodelStreamingIncome());
    }

    public function store(CreateCammodelStreamingIncomeRequest $request)
    {
        $this->cammodelStreamingIncomeServiceInterface->storeCammodelStreamingIncome($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-streaming-incomes.create')
            ->with('message', config('messaging.create'));
    }

    public function show(int $CammodelStreamingIncomeId)
    {
        return redirect()->route('admin.cammodel-streaming-incomes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function storeOffline(Request $request)
    {
        $this->cammodelStreamingIncomeServiceInterface->storeOfflineCammodelStreamingIncome($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-streaming-incomes.create-offline')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateCammodelStreamingIncomeRequest $request, $CammodelStreamingIncomeId)
    {
        $this->cammodelStreamingIncomeServiceInterface->updateCammodelStreamingIncome($request, $CammodelStreamingIncomeId);
        return back()->with('message', config('messaging.update'));
    }

    public function updatePackage(UpdateCammodelStreamingIncomeRequest $request, $CammodelStreamingIncomeId)
    {
        $this->cammodelStreamingIncomeServiceInterface->updateWorkReportStreamingIncomes($request);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $CammodelStreamingIncomeId)
    {
        $this->cammodelStreamingIncomeServiceInterface->destroyCammodelStreamingIncome($CammodelStreamingIncomeId);

        return redirect()->route('admin.cammodel-streaming-incomes.index')
            ->with('message', config('messaging.delete'));
    }
}
