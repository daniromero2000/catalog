<?php

namespace Modules\Companies\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;

class DashboardController extends Controller
{
    use RegistersUsers;
    private $actionInterface;

    public function __construct(
        ActionRepositoryInterface $actionRepositoryInterface
    ) {
        $this->actionInterface = $actionRepositoryInterface;
        $this->middleware('guest');
    }

    public function index()
    {
        return view('companies::admin.dashboard', [
            'user'        => auth()->guard('employee')->user(),
            'permissions' => session('permission')
        ]);
    }

    public function redirectAction($action_id)
    {
        session(['actionsModule' => []]);
        $actionsPerModule = session('actionsModuleOnlyId');
        $action           = $this->actionInterface->findActionById($action_id);
        if (in_array($action_id, $actionsPerModule[$action['permission_id']])) {
            $actions = session('actionsUser');
            if ($actions[$action['permission_id']]) {
                $actionsUser = $actions[$action['permission_id']];
                session(['actionsModule' => $actionsUser]);
            }
            return redirect()->route($action['route']);
        } else {
            return back();
        }
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
