<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelPayrolls;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelPayrolls\Exports\ExportCammodelPayroll;
use Modules\CamStudio\Entities\CammodelPayrolls\Exports\ExportCammodelPayrollBankTransfers;
use Modules\CamStudio\Entities\CammodelPayrolls\Requests\CreateCammodelPayrollRequest;
use Modules\CamStudio\Entities\CammodelPayrolls\Requests\UpdateCammodelPayrollRequest;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces\CammodelPayrollUseCaseInterface;

class CammodelPayrollsController extends Controller
{
    private $cammodelPayrollServiceInterface;

    public function __construct(
        CammodelPayrollUseCaseInterface $cammodelPayrollUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_payrolls, guard:employee']);
        $this->cammodelPayrollServiceInterface = $cammodelPayrollUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelPayrollServiceInterface->listCammodelPayrolls(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-payrolls.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-payrolls.create', $this->cammodelPayrollServiceInterface->createCammodelPayroll());
    }

    public function store(CreateCammodelPayrollRequest $request)
    {
        $this->cammodelPayrollServiceInterface->storeCammodelPayroll($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-payrolls.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id): View
    {
        return view('camstudio::admin.cammodel-payrolls.show', $this->cammodelPayrollServiceInterface->showCammodelPayroll($id));
    }

    public function update(UpdateCammodelPayrollRequest $request, int $id)
    {
        $this->cammodelPayrollServiceInterface->updateCammodelPayroll($request->except('_token', '_method'), $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->cammodelPayrollServiceInterface->destroyCammodelPayroll($id);

        return redirect()->route('admin.cammodel-payrolls.index')
            ->with('message', config('messaging.delete'));
    }

    public function exportCammodelPayroll($id)
    {
        $nombre =  $this->cammodelPayrollServiceInterface->exportCammodelPayroll($id);
        return (new ExportCammodelPayroll)->forId($id)->download($nombre);
    }

    public function exportCammodelPayrollBankTransfers($id)
    {
        $nombre = $this->cammodelPayrollServiceInterface->exportCammodelPayrollBankTransfers($id);
        return (new ExportCammodelPayrollBankTransfers)->forId($id)->download($nombre);
    }

    public function reCalculateCammodelPayroll($id)
    {
        $cammodelPayrollId =  $this->cammodelPayrollServiceInterface->reCalculateCammodelPayroll($id);

        return $this->show($cammodelPayrollId);
    }
}
