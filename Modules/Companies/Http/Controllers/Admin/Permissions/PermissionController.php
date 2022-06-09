<?php

namespace Modules\Companies\Http\Controllers\Admin\Permissions;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Modules\Companies\Entities\Permissions\Repositories\PermissionRepository;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Permissions\Requests\CreatePermissionRequest;
use Illuminate\Http\Request;
use Modules\Companies\Entities\PermissionGroups\Repositories\Interfaces\PermissionGroupRepositoryInterface;
use Modules\Companies\Entities\Permissions\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    private $permissionInterface, $toolsInterface, $permissionGroupInterface;

    public function __construct(
        PermissionRepositoryInterface $permissionRepositoryInterface,
        PermissionGroupRepositoryInterface $permissionGroupRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:permissions, guard:employee']);
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->permissionInterface      = $permissionRepositoryInterface;
        $this->permissionGroupInterface = $permissionGroupRepositoryInterface;
        $this->module                   = 'Permisos';
    }

    public function index(Request $request): View
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->permissionInterface->searchPermission(request()->input('q'), $skip * 10);
            $paginate = $this->permissionInterface->countPermission(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->permissionInterface->searchPermission(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->permissionInterface->countPermission(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->permissionInterface->countPermission(null);
            $list     = $this->permissionInterface->listPermission($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.permissions.list', [
            'permissions'   => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['ID', 'Nombre', 'Nombre Display',  'Ícono', 'Descripción', 'Opciones',],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create(): View
    {
        return view('companies::admin.permissions.create', [
            'optionsRoutes'    =>  config('generals.optionRoutes'),
            'module'           => $this->module,
            'permissionGroups' => $this->permissionGroupInterface->getAllPermissionGroups()
        ]);
    }

    public function store(CreatePermissionRequest $request)
    {
        $this->permissionInterface->createPermission($request->except(['_token']));

        return redirect()->route('admin.permissions.index')->with('message', 'Permiso Creado Exitosamente!');
    }

    public function show(int $permissionId)
    {
        return redirect()->route('admin.permissions.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdatePermissionRequest $request, int $permissionId)
    {
        $permissionRepository = new PermissionRepository($this->permissionInterface->findPermissionById($permissionId));
        $permissionRepository->updatePermission($request->input());
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $permissionId)
    {
        $permissionRepo = new PermissionRepository($this->permissionInterface->findPermissionById($permissionId));
        $permissionRepo->deletePermission();

        return back()->with('message', 'Eliminado Satisfactoriamente');
    }
}
