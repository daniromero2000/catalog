<?php

namespace Modules\Companies\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Roles\Requests\CreateRoleRequest;
use Modules\Companies\Entities\Roles\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    private $roleInterface,  $permissionInterface, $actionInterface;

    public function __construct(
        RoleRepositoryInterface $roleRepositoryInterface,
        PermissionRepositoryInterface $permissionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        ActionRepositoryInterface $actionRepositoryInterface
    ) {
        $this->middleware(['permission:roles, guard:employee']);
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->roleInterface       = $roleRepositoryInterface;
        $this->permissionInterface = $permissionRepositoryInterface;
        $this->actionInterface     = $actionRepositoryInterface;
        $this->module              = 'Roles';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->roleInterface->searchRole(request()->input('q'), $skip * 10);
            $paginate = $this->roleInterface->countRole(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->roleInterface->searchRole(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->roleInterface->countRole(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->roleInterface->countRole(null);
            $list     = $this->roleInterface->listRole($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        foreach ($list as $key => $value) {
            $roleRepo[$key]                    = new RoleRepository($list[$key]);
            $attachedPermissionsArrayIds[$key] = $roleRepo[$key]->listPermissions()->pluck('id')->all();
        }

        return view('companies::admin.roles.list', [
            'roles'                       => $list,
            'user'                        => auth()->guard('employee')->user(),
            'optionsRoutes'               =>  config('generals.optionRoutes'),
            'module'                      => $this->module,
            'skip'                        => $skip,
            'permissions'                 => $this->permissionInterface->getAllPermissionNames(),
            'attachedPermissionsArrayIds' => $attachedPermissionsArrayIds,
            'headers'                     => ['ID', 'Nombre', 'Nombre Display', 'Descripción', 'Opciones',],
            'paginate'                    => $getPaginate['paginate'],
            'position'                    => $getPaginate['position'],
            'page'                        => $getPaginate['page'],
            'limit'                       => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.roles.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $request['name'] = str_slug($request['display_name']);
        $this->roleInterface->createRole($request->except('_method', '_token'));

        return redirect()->route('admin.roles.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $roleId)
    {
        $role                        = $this->roleInterface->findRoleById($roleId);
        $roleRepo                    = new RoleRepository($role);
        $attachedPermissionsArrayIds = $roleRepo->listPermissions()->pluck('id')->all();

        return view('companies::admin.roles.edit', [
            'role'                        => $role,
            'permissions'                 => $this->permissionInterface->getAllPermissionNames()->groupBy('permission_group_id'),
            'attachedPermissionsArrayIds' => $attachedPermissionsArrayIds,
            'attachedActionsArrayIds'     => $roleRepo->listActions()->pluck('id')->all(),
            'actions'                     => $this->actionInterface->getAttachedActionNames($attachedPermissionsArrayIds)->groupBy('permission_id')
        ]);
    }

    public function edit($roleId)
    {
        $role                        = $this->roleInterface->findRoleById($roleId);
        $roleRepo                    = new RoleRepository($role);
        $attachedPermissionsArrayIds = $roleRepo->listPermissions()->pluck('id')->all();

        return view('companies::admin.roles.edit_actions', [
            'role'                        => $role,
            'permissions'                 => $this->permissionInterface->getAllPermissionNames()->groupBy('permission_group_id'),
            'attachedPermissionsArrayIds' => $attachedPermissionsArrayIds,
            'attachedActionsArrayIds'     => $roleRepo->listActions()->pluck('id')->all(),
            'actions'                     => $this->actionInterface->getAttachedActionNames($attachedPermissionsArrayIds)->groupBy('permission_id')
        ]);
    }

    public function update(UpdateRoleRequest $request, $roleId)
    {
        $roleRepo = new RoleRepository($this->roleInterface->findRoleById($roleId));
        if ($request->has('permissions')) {
            $roleRepo->syncPermissionss($request->input('permissions'));
            //  $roleRepo->syncActions($this->actionInterface->getAttachedActionNames($request->input('permissions'))->pluck('id')->all());
        }

        if ($request->has('actions')) {
            $roleRepo->syncActions($request['actions']);
        }

        $this->roleInterface->updateRole($request->except('_method', '_token'), $roleId);
        return back()->with('message', config('messaging.update'));
    }
}
