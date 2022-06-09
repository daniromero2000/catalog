<?php

namespace Modules\Companies\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Companies\Entities\Employees\Requests\CreateEmployeeRequest;
use Modules\Companies\Entities\Employees\Requests\UpdateEmployeeRequest;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Exceptions\EmployeeNotFoundException;
use Modules\Companies\Entities\Employees\Exceptions\UpdateEmployeeErrorException;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;


class EmployeeController extends Controller
{
    private $employeeInterface, $roleInterface, $departmentInterface;
    private $employeePositionInterface, $shiftInterface;
    private $employeeStatusesLogInterface, $cityInterface, $identityTypeInterface;
    private $stratumInterface, $housingInterface, $epsInterface;
    private $professionsListInterface, $toolsInterface, $subsidiaryInterface;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        RoleRepositoryInterface $roleRepositoryInterface,
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        EmployeePositionRepositoryInterface $employeePositionRepositoryInterface,
        EmployeeCommentaryRepositoryInterface $employeeCommentaryRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        IdentityTypeRepositoryInterface $identityTypeRepositoryInterface,
        StratumRepositoryInterface $stratumRepositoryInterface,
        HousingRepositoryInterface $housingRepositoryInterface,
        EpsRepositoryInterface $epsRepositoryInterface,
        ProfessionsListRepositoryInterface $professionsListRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->employeeInterface            = $employeeRepositoryInterface;
        $this->roleInterface                = $roleRepositoryInterface;
        $this->departmentInterface          = $departmentRepositoryInterface;
        $this->employeePositionInterface    = $employeePositionRepositoryInterface;
        $this->employeeCommentaryInterface  = $employeeCommentaryRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->cityInterface                = $cityRepositoryInterface;
        $this->identityTypeInterface        = $identityTypeRepositoryInterface;
        $this->stratumInterface             = $stratumRepositoryInterface;
        $this->housingInterface             = $housingRepositoryInterface;
        $this->epsInterface                 = $epsRepositoryInterface;
        $this->professionsListInterface     = $professionsListRepositoryInterface;
        $this->customerInterface            = $customerRepositoryInterface;
        $this->shiftInterface               = $shiftRepositoryInterface;
        $this->subsidiaryInterface          = $subsidiaryRepositoryInterface;
        $this->module                       = 'Empleados';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->employeeInterface->searchEmployee(request()->input('q'), $skip * 10);
            $paginate = $this->employeeInterface->countEmployee(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->employeeInterface->searchEmployee(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->employeeInterface->countEmployee(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->employeeInterface->countEmployee(null);
            $list     = $this->employeeInterface->listEmployees($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.employees.list', [
            'optionsRoutes'      => config('generals.optionRoutes'),
            'module'             => $this->module,
            'employees'          => $list,
            'optionsRoutes'      => config('generals.optionRoutes'),
            'skip'               => $skip,
            'headers'            => ['Id', 'Nombre', 'Email', 'Cargo', 'Estado', 'Opciones'],
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'all_departments'    => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'subsidiaries'       => $this->subsidiaryInterface->getAllSubsidiaryNames(),
            'shifts'             => $this->shiftInterface->getAllShiftNames(),
            'paginate'           => $getPaginate['paginate'],
            'position'           => $getPaginate['position'],
            'page'               => $getPaginate['page'],
            'limit'              => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.employees.create', [
            'optionsRoutes'      =>  config('generals.optionRoutes'),
            'module'             => $this->module,
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'departments'        => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'subsidiaries'       => $this->subsidiaryInterface->getAllSubsidiaryNames()
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));
        $employee = $this->employeeInterface->createEmployee($request->all() + ['customer_id' => $customer->id]);

        $data = [
            'employee_id' => $employee->id,
            'status'      => 'Empleado Creado',
            'user'        => auth()->guard('employee')->user()->name
        ];

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        $employeeRepo = new EmployeeRepository($employee);
        $employeeRepo->syncRoles([3]);
        $employee->password = Hash::make(12345678);
        $employee->save();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Empleado Creado Exitosamente!');
    }

    public function show(int $id)
    {
        return view('companies::admin.employees.show', [
            'employee'           => $this->employeeInterface->findEmployeeById($id),
            'cities'             => $this->cityInterface->getAllCityNames(),
            'identity_types'     => $this->identityTypeInterface->getAllIdentityTypesNames(),
            'stratums'           => $this->stratumInterface->getAllStratumsNames(),
            'housings'           => $this->housingInterface->getAllHousingsNames(),
            'epss'               => $this->epsInterface->getAllEpsNames(),
            'professions_lists'  => $this->professionsListInterface->getAllProfessionsNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'all_departments'    => $this->departmentInterface->getAllDepartmentNames(),
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'shifts'             => $this->shiftInterface->getAllShiftNames(),
            'subsidiaries'       => $this->subsidiaryInterface->getAllSubsidiaryNames()
        ]);
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.employees.index');
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $requestData = $request->except(
            '_token',
            '_method',
        );

        $employee      = $this->employeeInterface->findEmployeeById($id);
        $isCurrentUser = $this->employeeInterface->isAuthUser($employee);
        $empRepo       = new EmployeeRepository($employee);

        if ($request->hasFile('signature') || $request->hasFile('avatar')) {
            if ($employee->employeeIdentities->isEmpty()) {
                return back()->with('error', 'El empleado no tiene identificación asignada');
            }
        }

        if ($request->hasFile('signature')) {
            if ($employee->signature) {
                $this->toolsInterface->deleteThumbFromServer($employee->signature);
            }
            $requestData['signature'] = $empRepo->saveEmployeeSignature($request->file('signature'), $employee->employeeIdentities[0]->identity_number);
        }

        if ($request->hasFile('avatar')) {
            if ($employee->signature) {
                $this->toolsInterface->deleteThumbFromServer($employee->avatar);
            }
            $requestData['avatar'] = $empRepo->saveEmployeeSignature($request->file('avatar'), $employee->employeeIdentities[0]->identity_number);
        }

        $empRepo->updateEmployee($requestData);

        if ($request->has('roles') and !$isCurrentUser) {
            $employee->roles()->sync($request->input('roles'));
        } elseif (!$isCurrentUser) {
            $employee->roles()->detach();
        }

        return back()->with('message', 'Actualización exitosa');
    }

    public function destroy(int $id)
    {
        $employeeRepo = new EmployeeRepository($this->employeeInterface->findEmployeeById($id));
        $employeeRepo->deleteEmployee();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }
}
