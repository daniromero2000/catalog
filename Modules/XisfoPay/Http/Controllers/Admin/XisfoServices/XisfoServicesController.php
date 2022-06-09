<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\XisfoServices;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\XisfoServiceRepository;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\Interfaces\XisfoServiceRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoServices\Requests\CreateXisfoServiceRequest;
use Modules\XisfoPay\Entities\XisfoServices\Requests\UpdateXisfoServiceRequest;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;

class XisfoServicesController extends Controller
{
    private $toolsInterface, $xisfoServiceInterface, $employeeInterface;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        XisfoServiceRepositoryInterface $xisfoServiceRepositoryInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->employeeInterface     = $employeeRepositoryInterface;
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->xisfoServiceInterface = $xisfoServiceRepositoryInterface;
        $this->module                = 'Servicios Xisfo';
    }

    public function index(Request $request)
    {
        $skip = 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->xisfoServiceInterface->searchXisfoService(request()->input('q'), $skip * 10);
            $paginate = $this->xisfoServiceInterface->countXisfoService(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->xisfoServiceInterface->searchXisfoService(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->xisfoServiceInterface->countXisfoService(request()->input('t'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->xisfoServiceInterface->countXisfoService(null);
            $list     = $this->xisfoServiceInterface->listXisfoServices($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('xisfopay::admin.xisfo-services.list', [
            'xisfo_services' => $list,
            'optionsRoutes'  =>  config('generals.optionRoutes'),
            'module'         => $this->module,
            'headers'        => ['Servicio', 'Activo', 'Opciones'],
            'skip'           => $skip,
            'paginate'       => $getPaginate['paginate'],
            'position'       => $getPaginate['position'],
            'page'           => $getPaginate['page'],
            'limit'          => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('xisfopay::admin.xisfo-services.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['Servicio', 'Activo', 'Opciones']
        ]);
    }

    public function show(int $id)
    {
        $xisfoService                = $this->xisfoServiceInterface->findXisfoServiceById($id);
        $xisfoServiceRepo            = new XisfoServiceRepository($xisfoService);
        $attachedEmployeesArrayIds     = $xisfoServiceRepo->listEmployees()->pluck('id')->all();
        return view('xisfopay::admin.xisfo-services.show', [
            'module'       => 'Servicios Xisfo',
            'xisfoService' => $this->xisfoServiceInterface->findXisfoServiceById($id),
            'employees' => $this->employeeInterface->getAllEmployeesNames(),
            'attachedEmployeesArrayIds'     => $attachedEmployeesArrayIds
        ]);
    }

    public function store(CreateXisfoServiceRequest $request)
    {
        $this->xisfoServiceInterface->createXisfoService($request->except('_token', '_method', 'image'));
        return redirect()->route('admin.xisfo-services.index')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateXisfoServiceRequest $request, $id)
    {
        $xisfoService = $this->xisfoServiceInterface->findXisfoServiceById($id);
        $xisfoServiceRepo = new XisfoServiceRepository($xisfoService);
        $xisfoServiceRepo->syncEmployee(($request->input('employee_id')));
        $update = new XisfoServiceRepository($xisfoService);
        $update->updateXisfoService($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->xisfoServiceInterface->findXisfoServiceById($id)->delete();

        return redirect()->route('admin.xisfo-services.index')
            ->with('message', config('messaging.delete'));
    }
}
