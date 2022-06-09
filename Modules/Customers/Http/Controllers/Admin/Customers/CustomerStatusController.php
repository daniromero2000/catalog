<?php

namespace Modules\Customers\Http\Controllers\Admin\Customers;


use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerStatuses\Repositories\CustomerStatusRepository;
use Modules\Customers\Entities\CustomerStatuses\Requests\CreateCustomerStatusRequest;
use Modules\Customers\Entities\CustomerStatuses\Requests\UpdateCustomerStatusRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CustomerStatusController extends Controller
{
    private $customerStatusesInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CustomerStatusRepositoryInterface $customerStatusRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:employee']);
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->customerStatusesInterface = $customerStatusRepositoryInterface;
        $this->module                    = 'Estados Clientes';

    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->customerStatusesInterface->searchCustomerStatuses(request()->input('q'), $skip * 10);
            $paginate = $this->customerStatusesInterface->countCustomerStatuses(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->customerStatusesInterface->searchCustomerStatuses(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->customerStatusesInterface->countCustomerStatuses(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->customerStatusesInterface->countCustomerStatuses(null);
            $list     = $this->customerStatusesInterface->listCustomerStatus($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'user'          => auth()->guard('employee')->user(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['ID', 'Nombre', 'Color', 'Estado', 'Opciones'],
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('customers::admin.customer-statuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCustomerStatusRequest $request)
    {
        if (!strpos($request['color'], '#')) {
            $request['color'] = '#' . $request['color'];
        }

        $this->customerStatusesInterface->createCustomerStatus($request->except('_token', '_method'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.customer-statuses.index');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.customer-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function edit(int $id)
    {
        return view('customers::admin.customer-statuses.edit', [
            'customerStatus' => $this->customerStatusesInterface->findCustomerStatusById($id)
        ]);
    }

    public function update(UpdateCustomerStatusRequest $request, int $id)
    {
        $update = new CustomerStatusRepository($this->customerStatusesInterface->findCustomerStatusById($id));
        $update->updateCustomerStatus($request->all());
        $request->session()->flash('message', config('messaging.update'));

        return redirect()->route('admin.customer-statuses.edit', $id);
    }

    public function destroy(int $id)
    {
        $customerStatus = new CustomerStatusRepository($this->customerStatusesInterface->findCustomerStatusById($id));
        $customerStatus->deleteCustomerStatus();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');
        return redirect()->route('admin.customer-statuses.index');
    }
}
