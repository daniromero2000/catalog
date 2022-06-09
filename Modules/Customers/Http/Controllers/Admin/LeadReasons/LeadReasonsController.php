<?php

namespace Modules\Customers\Http\Controllers\Admin\LeadReasons;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\LeadReasons\Repositories\Interfaces\LeadReasonRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class LeadReasonsController extends Controller
{
    private $toolsInterface, $leadReasonInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        LeadReasonRepositoryInterface $leadReasonRepositoryInterface
    ) {
        $this->middleware(['permission:lead_reasons, guard:employee']);
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->leadReasonInterface = $leadReasonRepositoryInterface;
        $this->module              = 'Motivos Leads';
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $skip = 0;
            $list = $this->leadReasonInterface->searchLeadReason(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->leadReasonInterface->listLeadReasons($skip * 10);
        }

        return view('customers::admin.lead-reasons.list', [
            'datas'         => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['ID', 'Motivo', 'Empresa', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('customers::admin.lead-reasons.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateLeadReasonRequest $request)
    {
        $this->leadReasonInterface->createLeadReason($request->except('_token', '_method'));

        return redirect()->route('admin.lead-reasons.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.lead-reasons.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateLeadReasonRequest $request, $id)
    {
        $update = new LeadReasonRepository($this->leadReasonInterface->findLeadReasonById($id));
        $update->updateLeadReason($request->except('_token', '_method'));

        return redirect()->route('admin.lead-reasons.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->leadReasonsInterface->findLeadReasonsById($id)->delete();

        return redirect()->route('admin.lead-reasons.index')
            ->with('message', config('messaging.delete'));
    }
}
