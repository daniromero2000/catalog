<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeWorkingHours;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\EmployeeWorkingHours\Repositories\EmployeeWorkingHourRepository;
use Modules\Companies\Entities\EmployeeWorkingHours\Repositories\Interfaces\EmployeeWorkingHourRepositoryInterface;
use Modules\Companies\Entities\EmployeeWorkingHours\Requests\CreateEmployeeWorkingHourRequest;
use Modules\Companies\Entities\EmployeeWorkingHours\Requests\UpdateEmployeeWorkingHourRequest;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;


class EmployeeWorkingHoursController extends Controller
{
    private $toolsInterface, $employeeWorkingHourInterfa, $employeeInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        EmployeeWorkingHourRepositoryInterface $xisfoServiceRepositoryInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->employeeWorkingHourInterfa = $xisfoServiceRepositoryInterface;
        $this->employeeInterface          = $employeeRepositoryInterface;
        $this->module                     = 'Horas Laborales';
    }

    public function index(Request $request)
    {
        $skip = 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->employeeWorkingHourInterfa->searchEmployeeWorkingHour(request()->input('q'), $skip * 10);
            $paginate = $this->employeeWorkingHourInterfa->countEmployeeWorkingHour(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->employeeWorkingHourInterfa->searchEmployeeWorkingHour(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->employeeWorkingHourInterfa->countEmployeeWorkingHour(request()->input('t'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->employeeWorkingHourInterfa->countEmployeeWorkingHour(null);
            $list     = $this->employeeWorkingHourInterfa->listEmployeeWorkingHours($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.employee-working-hours.index', [
            'working_hours' => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['Servicio', 'Activo', 'Opciones'],
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.employee-working-hours.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['Servicio', 'Activo', 'Opciones'],
            'employees'     => $this->employeeInterface->getAllEmployeesNames()
        ]);
    }

    public function store(CreateEmployeeWorkingHourRequest $request)
    {
        $this->employeeWorkingHourInterfa->createEmployeeWorkingHour($request->except('_token', '_method', 'image'));

        return redirect()->route('admin.employee-working-hours.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateEmployeeWorkingHourRequest $request, $id)
    {
        $update = new EmployeeWorkingHourRepository($this->employeeWorkingHourInterfa->findEmployeeWorkingHourById($id));
        $update->updateEmployeeWorkingHour($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->employeeWorkingHourInterfa->findEmployeeWorkingHourById($id)->delete();

        return redirect()->route('admin.employee-working-hours.index')
            ->with('message', config('messaging.delete'));
    }
}
