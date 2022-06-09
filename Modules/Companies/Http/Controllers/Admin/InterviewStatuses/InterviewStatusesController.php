<?php

namespace Modules\Companies\Http\Controllers\Admin\InterviewStatuses;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Modules\Companies\Entities\InterviewStatuses\Repositories\InterviewStatusRepository;
use Modules\Companies\Entities\InterviewStatuses\Requests\CreateInterviewStatusRequest;
use Modules\Companies\Entities\InterviewStatuses\Requests\UpdateInterviewStatusRequest;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class InterviewStatusesController extends Controller
{
    private $interviewStatusesInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        InterviewStatusRepositoryInterface $interviewStatusRepositoryInterface
    ) {
        $this->middleware(['permission:interviews, guard:employee']);
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->interviewStatusesInterface = $interviewStatusRepositoryInterface;
        $this->module                     = 'Estados Entrevistas';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->interviewStatusesInterface->searchInterviewStatuses(request()->input('q'), $skip * 10);
            $paginate = $this->interviewStatusesInterface->countInterviewStatuses(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->interviewStatusesInterface->searchInterviewStatuses(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->interviewStatusesInterface->countInterviewStatuses(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->interviewStatusesInterface->countInterviewStatuses(null);
            $list     = $this->interviewStatusesInterface->listInterviewStatuses($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'user'          => auth()->guard('employee')->user(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['ID', 'Nombre', 'Color', 'Estado', 'Opciones'],
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.interview-statuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateInterviewStatusRequest $request)
    {
        if (!strpos($request['color'], '#')) {
            $request['color'] = '#' . $request['color'];
        }

        $this->interviewStatusesInterface->createInterviewStatus($request->except('_token', '_method'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.interview-statuses.index');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.interview-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function edit($id)
    {
        return view('companies::admin.interview-statuses.edit', [
            'interviewStatus' => $this->interviewStatusesInterface->findInterviewStatusById($id)
        ]);
    }

    public function update(UpdateInterviewStatusRequest $request, $id)
    {
        $update = new InterviewStatusRepository($this->interviewStatusesInterface->findInterviewStatusById($id));
        $update->updateInterviewStatus($request->all());
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $interviewStatus = new InterviewStatusRepository($this->interviewStatusesInterface->findinterviewStatusById($id));
        $interviewStatus->deleteinterviewStatus();

        return redirect()->route('admin.interview-statuses.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
