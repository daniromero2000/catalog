<?php

namespace Modules\Companies\Http\Controllers\Admin\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\ActionRepository;
use Modules\Companies\Entities\Actions\Requests\CreateActionRequest;
use Modules\Companies\Entities\Actions\Requests\UpdateActionRequest;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;

class ActionController extends Controller
{
    private $actionsInterface, $toolsInterface, $permissionInterface;

    public function __construct(
        ActionRepositoryInterface $actionRepositoryInterface,
        PermissionRepositoryInterface $permissionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:actions, guard:employee']);
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->permissionInterface = $permissionRepositoryInterface;
        $this->actionsInterface    = $actionRepositoryInterface;
        $this->module              = 'Acciones';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->actionsInterface->searchAction(request()->input('q'), $skip * 10);
            $paginate = $this->actionsInterface->countAction(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->actionsInterface->searchAction(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->actionsInterface->countAction(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->actionsInterface->countAction(null);
            $list     = $this->actionsInterface->listActions($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.actions.list', [
            'module'          => 'Acciones',
            'EmployeeActions' => $list,
            'optionsRoutes'   => config('generals.optionRoutes'),
            'headers'         => ['ID',  'NOMBRE MÓDULO',  'NOMBRE ACCIÓN',  'ÍCONO',  'RUTA', 'ACCIONES',],
            'permissions'     => $this->permissionInterface->getAllPermissionNames(),
            'skip'            => $skip,
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.actions.create', [
            'optionsRoutes'    =>  config('generals.optionRoutes'),
            'module'           => $this->module,
            'permissions'      => $this->permissionInterface->getAllPermissionNames()
        ]);
    }

    public function store(CreateActionRequest $request)
    {
        $this->actionsInterface->createAction($request->except(['_token']));
        return back()->with('message', 'Acción Creado Exitosamente!');
    }

    public function update(UpdateActionRequest $request, $id)
    {
        $update = new ActionRepository($this->actionsInterface->findActionById($id));
        $update->updateAction($request->except('_token', '_method'));
        $request->session()->flash('message', 'Actualizacion Exitosa');
        return back();
    }

    public function destroy($id)
    {
        $action     = $this->actionsInterface->findActionById($id);
        $actionRepo = new ActionRepository($action);
        $actionRepo->deleteAction();

        return redirect()->route('admin.actions.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.actions.index')
            ->with('error', config('messaging.not_found'));
    }
}
