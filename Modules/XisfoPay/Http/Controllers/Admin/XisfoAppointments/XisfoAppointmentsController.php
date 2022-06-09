<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\XisfoAppointments;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\XisfoAppointmentNotFoundException;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\CreateXisfoAppointmentErrorException;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\DeletingXisfoAppointmentErrorException;
use Modules\XisfoPay\Entities\XisfoAppointments\Repositories\XisfoAppointmentRepository;
use Modules\XisfoPay\Entities\XisfoAppointments\Repositories\Interfaces\XisfoAppointmentRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoAppointments\Requests\CreateXisfoAppointmentRequest;
use Modules\XisfoPay\Entities\XisfoAppointments\Requests\UpdateXisfoAppointmentRequest;


class XisfoAppointmentsController extends Controller
{
    private $toolsInterface, $xisfoServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        XisfoAppointmentRepositoryInterface $xisfoServiceRepositoryInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->xisfoServiceInterface = $xisfoServiceRepositoryInterface;
        $this->module                = 'Citas Xisfo';
    }

    public function index(Request $request)
    {
        $skip = 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->xisfoServiceInterface->searchXisfoAppointment(request()->input('q'), $skip * 10);
            $paginate = $this->xisfoServiceInterface->countXisfoAppointment(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->xisfoServiceInterface->searchXisfoAppointment(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->xisfoServiceInterface->countXisfoAppointment(request()->input('t'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->xisfoServiceInterface->countXisfoAppointment(null);
            $list     = $this->xisfoServiceInterface->listXisfoAppointments($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('xisfopay::admin.xisfo-appointments.list', [
            'xisfo_services' => $list,
            'optionsRoutes'  =>  config('generals.optionRoutes'),
            'module'         => $this->module,
            'headers'        => ['Servicio', 'Activo', 'Opciones'],
            'skip'           => $skip,
            'paginate'       => $getPaginate['paginate'],
            'position'       => $getPaginate['position'],
            'page'           => $getPaginate['page'],
            'limit'          => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('xisfopay::admin.xisfo-appointments.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['Servicio', 'Activo', 'Opciones']
        ]);
    }

    public function store(CreateXisfoAppointmentRequest $request)
    {
        $this->xisfoServiceInterface->createXisfoAppointment($request->except('_token', '_method', 'image'));

        return redirect()->route('admin.xisfo-appointments.index')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateXisfoAppointmentRequest $request, $id)
    {
        $xisfoService = $this->xisfoServiceInterface->findXisfoAppointmentById($id);
        $update = new XisfoAppointmentRepository($xisfoService);
        $update->updateXisfoAppointment($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->xisfoServiceInterface->findXisfoAppointmentById($id)->delete();

        return redirect()->route('admin.xisfo-appointments.index')
            ->with('message', config('messaging.delete'));
    }
}
