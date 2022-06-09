<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequestStatuses;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\ContractRequestStatusRepository;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\Interfaces\ContractRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Requests\CreateContractRequestStatusRequest;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Requests\UpdateContractRequestStatusRequest;

class ContractRequestStatusesController extends Controller
{
    private $toolsInterface, $contractRequestStatusInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRequestStatusRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:contract_request_statuses, guard:employee']);
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->contractRequestStatusInterface = $contractStatusRepositoryInterface;
        $this->module                         = 'Estados Solicitudes de Contrato';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->contractRequestStatusInterface->searchContractRequestStatus(request()->input('q'), $skip * 10);
            $paginate = $this->contractRequestStatusInterface->countContractRequestStatus(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->contractRequestStatusInterface->searchContractRequestStatus(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->contractRequestStatusInterface->countContractRequestStatus(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->contractRequestStatusInterface->countContractRequestStatus(null);
            $list     = $this->contractRequestStatusInterface->listContractRequestStatuses($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['ID', 'Nombre', 'Color', 'Estado', 'Opciones'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('generals::layouts.admin.entity-estatuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateContractRequestStatusRequest $request)
    {
        $this->contractRequestStatusInterface->createContractRequestStatus($request->except('_token', '_method'));

        return redirect()->route('admin.contract-request-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.contract-request-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateContractRequestStatusRequest $request, $id)
    {
        $contractStatus = $this->contractRequestStatusInterface->findContractRequestStatusById($id);
        $update = new ContractRequestStatusRepository($contractStatus);
        $update->updateContractRequestStatus($request->except('_token', '_method'));

        return redirect()->route('admin.contract-request-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->contractRequestStatusInterface->findContractRequestStatusById($id)->delete();

        return redirect()->route('admin.contract-request-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}
