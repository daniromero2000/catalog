<?php

namespace Modules\Customers\Http\Controllers\Admin\LeadStatuses;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Customers\Entities\LeadStatuses\Repositories\LeadStatusRepository;
use Modules\Customers\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Modules\Customers\Entities\LeadStatuses\Requests\CreateLeadStatusRequest;
use Modules\Customers\Entities\LeadStatuses\Requests\UpdateLeadStatusRequest;

class LeadStatusesController extends Controller
{
    private $toolsInterface, $leadStatusInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        LeadStatusRepositoryInterface $leadStatusRepositoryInterface
    ) {
        $this->middleware(['permission:lead_statuses, guard:employee']);
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->leadStatusInterface = $leadStatusRepositoryInterface;
        $this->module              = 'Estados Leads';
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $skip = 0;
            $list = $this->leadStatusInterface->searchLeadStatus(request()->input('q'));
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->leadStatusInterface->listLeadStatuses($skip * 10);
        }

        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['ID', 'Nombre', 'Color',  'Estado', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('generals::layouts.admin.entity-estatuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateLeadStatusRequest $request)
    {
        $this->leadStatusInterface->createLeadStatus($request->except('_token', '_method'));

        return redirect()->route('admin.lead-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.lead-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateLeadStatusRequest $request, $id)
    {
        $update = new LeadStatusRepository($this->leadStatusInterface->findLeadStatusById($id));
        $update->updateLeadStatus($request->except('_token', '_method'));

        return redirect()->route('admin.lead-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->leadStatusInterface->findLeadStatusById($id)->delete();

        return redirect()->route('admin.lead-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}
