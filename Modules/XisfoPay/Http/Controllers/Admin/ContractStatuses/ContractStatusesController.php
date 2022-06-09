<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractStatuses;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\ContractStatusRepository;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\Interfaces\ContractStatusRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatuses\Requests\CreateContractStatusRequest;
use Modules\XisfoPay\Entities\ContractStatuses\Requests\UpdateContractStatusRequest;

class ContractStatusesController extends Controller
{
    private $toolsInterface, $contractStatusInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractStatusRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:contract_statuses, guard:employee']);
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->contractStatusInterface = $contractStatusRepositoryInterface;
        $this->module                  = 'Estados Contratos';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->contractStatusInterface->searchContractStatus(request()->input('q'), $skip * 10);
            $paginate = $this->contractStatusInterface->countContractStatus(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->contractStatusInterface->searchContractStatus(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->contractStatusInterface->countContractStatus(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->contractStatusInterface->countContractStatus(null);
            $list     = $this->contractStatusInterface->listContractStatuses($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['ID', 'Nombre', 'Color',  'Estado', 'Opciones'],
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

    public function store(CreateContractStatusRequest $request)
    {
        $this->contractStatusInterface->createContractStatus($request->except('_token', '_method'));

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.contract-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateContractStatusRequest $request, $id)
    {
        $contractStatus = $this->contractStatusInterface->findContractStatusById($id);
        $update = new ContractStatusRepository($contractStatus);
        $update->updateContractStatus($request->except('_token', '_method'));

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->contractStatusInterface->findContractStatusById($id)->delete();

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}