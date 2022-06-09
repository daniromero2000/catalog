<?php

namespace Modules\Companies\Http\Controllers\Admin\Interviews;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\Interviews\Repositories\Interfaces\InterviewRepositoryInterface;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class InterviewsController extends Controller
{
    private $interviewsInterface, $toolsInterface, $employeePositionInterface;
    private $subsidiaryInterface, $interviewStatusInterface;

    public function __construct(
        InterviewRepositoryInterface $interviewRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        EmployeePositionRepositoryInterface $employeePositionRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        InterviewStatusRepositoryInterface $interviewStatusRepositoryInterface
    ) {
        $this->middleware(['permission:interviews, guard:employee']);
        $this->interviewsInterface       = $interviewRepositoryInterface;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->employeePositionInterface = $employeePositionRepositoryInterface;
        $this->subsidiaryInterface       = $subsidiaryRepositoryInterface;
        $this->interviewStatusInterface  = $interviewStatusRepositoryInterface;
        $this->module                    = 'Entrevistas';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->interviewsInterface->searchInterview(request()->input('q'), $skip * 10);
            $paginate = $this->interviewsInterface->countInterview(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->interviewsInterface->searchInterview(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->interviewsInterface->countInterview(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->interviewsInterface->countInterview(null);
            $list     = $this->interviewsInterface->listInterviews($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.interviews.list', [
            'interviews'         => $list,
            'optionsRoutes'      =>  config('generals.optionRoutes'),
            'module'             => $this->module,
            'skip'               => $skip,
            'headers'            => ['Id', 'Nombre', 'Email', 'Cargo', 'Estado', 'Opciones'],
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'paginate'           => $getPaginate['paginate'],
            'position'           => $getPaginate['position'],
            'page'               => $getPaginate['page'],
            'limit'              => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.interviews.create', [
            'optionsRoutes'      =>  config('generals.optionRoutes'),
            'module'             => $this->module,
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'subsidiaries'       => $this->subsidiaryInterface->getAllSubsidiaryNames(),
            'interview_statuses' => $this->interviewStatusInterface->getAllInterviewStatusesNames()
        ]);
    }

    public function store(Request $request)
    {

        $this->interviewsInterface->createInterview($request->all());

        return redirect()->route('admin.interviews.index')
            ->with('message', 'Empleado Creado Exitosamente!');
    }

    public function show($id)
    {
        return view('companies::admin.interviews.show', [
            'interview'          => $this->interviewsInterface->findInterviewById($id),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames()
        ]);
    }

    public function edit($id)
    {
        return view('companies::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
