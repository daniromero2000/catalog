<?php

namespace Modules\Customers\Http\Controllers\Admin\Leads;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Leads\Requests\CreateLeadRequest;
use Modules\Customers\Entities\Leads\Requests\UpdateLeadRequest;
use Modules\Customers\Entities\Leads\UseCases\Interfaces\LeadUseCaseInterface;

class LeadsController extends Controller
{
    private $leadUseCaseInterface;

    public function __construct(
        LeadUseCaseInterface $leadUseCaseInterface
    ) {
        $this->middleware(['permission:leads, guard:employee']);
        $this->leadUseCaseInterface = $leadUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->leadUseCaseInterface->listLeads(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('customers::admin.leads.list', $response['data']);
    }

    public function create()
    {
        return view('customers::admin.leads.create', $this->leadUseCaseInterface->createLead());
    }

    public function store(CreateLeadRequest $request)
    {
        $this->leadUseCaseInterface->storeLead($request->except('_token', '_method'));

        return redirect()->route('admin.leads.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return view('customers::admin.leads.show', $this->leadUseCaseInterface->showLead($id));
    }

    public function update(UpdateLeadRequest $request, int $id)
    {
        $this->leadUseCaseInterface->updateLead($request->except('_token', '_method'), $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->leadUseCaseInterface->destroyLead($id);

        return redirect()->route('admin.leads.index')
            ->with('message', config('messaging.delete'));
    }
}
