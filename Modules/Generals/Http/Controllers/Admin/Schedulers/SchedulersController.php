<?php

namespace Modules\Generals\Http\Controllers\Admin\Schedulers;

use Modules\Generals\Entities\Schedulers\Repositories\Interfaces\SchedulerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Schedulers\Requests\CreateSchedulerRequest;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Schedulers\Requests\UpdateSchedulerRequest;
use Modules\Companies\Entities\EmployeeWorkingHours\Repositories\Interfaces\EmployeeWorkingHourRepositoryInterface;

class SchedulersController extends Controller
{
    private $employeeWorkingHourInterfa;
    public function __construct(
        SchedulerRepositoryInterface $schedulerRepositoryInterface,
        EmployeeWorkingHourRepositoryInterface $employeeWorkingHourRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        //$this->middleware(['permission:schedulers, guard:employee']);
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->schedulerInterface         = $schedulerRepositoryInterface;
        $this->employeeWorkingHourInterfa = $employeeWorkingHourRepositoryInterface;
    }
    public function viewScheduler($id)
    {
        return view('generals::admin.schedulers.scheduler', [
            'id_user' => $id
        ]);
    }

    public function createEventHandler(CreateSchedulerRequest $request)
    {
        if ($request->get('employee_id') || $request->get('title') != 'null' || $request->get('date') || $request->get('time')) {
            $employee_id = $request->get('employee_id');
            $title = $request->get('title');
            $date = $request->get('date');
            $time = $request->get('time');
            $params =  array(
                'employee_id' => $request->get('employee_id'),
                'date' => $request->get('date'),
                'time' => $request->get('time'),
                'title' => $request->get('title')
            );
            $create = $this->schedulerInterface->createScheduler($params);
            return response()->json($employee_id);
        } else {
            return 'Campos vacios';
            return response()->json('Algún campo vacio...');
        }
    }

    public function getEventHandler(Request $request)
    {
        $scheduler = $this->schedulerInterface->findSchedulerByIdEmployee($request->get('employee_id'));
        return response()->json($scheduler);
    }

    public function getWorkingHour(Request $request)
    {
        $id = $request->get('employee_id');
        $workingHour = $this->employeeWorkingHourInterfa->getEmployee($id);
        return $workingHour;
        return response()->json($workingHour);
    }

    public function update(UpdateSchedulerRequest $request, $id)
    {
    }

    public function deleteEventHandler(Request $request)
    {
        $resp = $this->schedulerInterface->findSchedulerById($request->get('id'))->delete();
        return response()->json($resp);
    }
}
