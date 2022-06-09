<?php

namespace Modules\Companies\Http\Controllers\Admin\Departments;

use Modules\Companies\Entities\Departments\Repositories\DepartmentRepository;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\Departments\Requests\CreateDepartmentRequest;
use Modules\Companies\Entities\Departments\Requests\UpdateDepartmentRequest;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private $departmentInterface,  $cityInterface;

    public function __construct(
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->middleware(['permission: departments, guard: employee']);
        $this->departmentInterface    = $departmentRepositoryInterface;
        $this->cityInterface          = $cityRepositoryInterface;
        $this->module                 = 'Números Corporativos';
    }

    public function index(Request $request)
    {
        if ($request->input('skip') == null) {
            $skip      = 0;
            $totalView = $skip * 0;
        } else {
            $skip      = $request->input('skip');
            $totalView = $request->input('skip') * 30;
        }

        if (request()->has('q')) {
            $list = $this->departmentInterface->searchDepartment(request()->input('q'));
        } else {
            $list =  $this->departmentInterface->listDepartments($totalView);
        }

        return view('companies::admin.departments.list', [
            'departments'   => $list,
            'skip'          => $skip,
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['ID', 'Sucursal', 'Dirección', 'Teléfono', 'Ciudad', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('companies::admin.departments.create', [
            'cities'        => $this->cityInterface->getAllCityNames(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateDepartmentRequest $request)
    {
        $this->departmentInterface->createDepartment($request->except('_token', '_method'));

        return redirect()->route('admin.departments.index')
            ->with('message', 'Departamento Creado Exitosamente!');
    }

    public function show($id)
    {
        $department = $this->departmentInterface->findDepartmentById($id);

        return view('companies::admin.departments.show', [
            'department'  => $department,
            'departments' => $department->children
        ]);
    }

    public function edit($id)
    {
        $department = $this->departmentInterface->findDepartmentById($id);

        return view('companies::admin.departments.edit', [
            'department' => $department,
            'cities'     => $this->cityInterface->getAllCityNames(),
            'cityId'     => $department->city_id
        ]);
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $update = new DepartmentRepository($this->departmentInterface->findDepartmentById($id));
        $update->updateDepartment($request->except('_token', '_method'));

        return redirect()->route('admin.departments.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy(int $id)
    {
        $department = new DepartmentRepository($this->departmentInterface->findDepartmentById($id));
        $department->deleteDepartment();

        return redirect()->route('admin.departments.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
