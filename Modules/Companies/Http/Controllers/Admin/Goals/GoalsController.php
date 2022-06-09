<?php

namespace Modules\Companies\Http\Controllers\Admin\Goals;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Goals\Requests\CreateGoalRequest;
use Modules\Companies\Entities\Goals\Requests\UpdateGoalRequest;
use Modules\Companies\Entities\Goals\UseCases\Interfaces\GoalUseCaseInterface;

class GoalsController extends Controller
{
    private $goalServiceInterface;

    public function __construct(
        GoalUseCaseInterface $goalUseCaseInterface
    ) {
        $this->middleware(['permission:goals, guard:employee']);
        $this->goalServiceInterface = $goalUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->goalServiceInterface->listGoals(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('companies::admin.goals.list', $response['data']);
    }

    public function create()
    {
        return view('companies::admin.goals.create', $this->goalServiceInterface->createGoal());
    }

    public function store(CreateGoalRequest $request)
    {
        $this->goalServiceInterface->storeGoal($request->except('_token', '_method'));

        return redirect()->route('admin.goals.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.goals.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateGoalRequest $request, $id)
    {
        $this->goalServiceInterface->updateGoal($request, $id);

        return redirect()->route('admin.goals.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->goalServiceInterface->destroyGoal($id);

        return redirect()->route('admin.goals.index')
            ->with('message', config('messaging.delete'));
    }
}
