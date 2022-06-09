<?php

namespace Modules\Companies\Http\Controllers\Admin\Kpis;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Kpis\Requests\CreateKpiRequest;
use Modules\Companies\Entities\Kpis\Requests\UpdateKpiRequest;
use Modules\Companies\Entities\Kpis\UseCases\Interfaces\KpiUseCaseInterface;

class KpisController extends Controller
{
    private $kpiServiceInterface;

    public function __construct(KpiUseCaseInterface $kpiUseCaseInterface)
    {
        $this->middleware(['permission:kpis, guard:employee']);
        $this->kpiServiceInterface = $kpiUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->kpiServiceInterface->listKpis(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('companies::admin.kpis.list', $response['data']);
    }

    public function create(): View
    {
        return view('companies::admin.kpis.create', $this->kpiServiceInterface->createKpi());
    }

    public function store(CreateKpiRequest $request)
    {
        $this->kpiServiceInterface->storeKpi($request->except('_token', '_method'));

        return redirect()->route('admin.kpis.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $kpiId)
    {
        return redirect()->route('admin.kpis.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateKpiRequest $request, $kpiId)
    {
        $this->kpiServiceInterface->updateKpi($request, $kpiId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $kpiId)
    {
        $this->kpiServiceInterface->destroyKpi($kpiId);
        return back()->with('message', config('messaging.delete'));
    }
}
