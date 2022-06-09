<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentRequestStatuses;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\PaymentRequestStatusRepository;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Requests\CreatePaymentRequestStatusRequest;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Requests\UpdatePaymentRequestStatusRequest;

class PaymentRequestStatusesController extends Controller
{
    private $toolsInterface, $contractRequestStatusInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentRequestStatusRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:payment_request_statuses, guard:employee']);
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->contractRequestStatusInterface = $contractStatusRepositoryInterface;
        $this->module                         = 'Estados Solicitud Pago';
    }

    public function index(Request $request)
    {
        $skip = 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->contractRequestStatusInterface->searchPaymentRequestStatus(request()->input('q'), $skip * 10);
            $paginate = $this->contractRequestStatusInterface->countPaymentRequestStatus(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->contractRequestStatusInterface->searchPaymentRequestStatus(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->contractRequestStatusInterface->countPaymentRequestStatus(request()->input('t'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->contractRequestStatusInterface->countPaymentRequestStatus(null);
            $list = $this->contractRequestStatusInterface->listPaymentRequestStatuses($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::layouts.admin.entity-estatuses.list', [
            'datas'         => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['ID', 'Nombre', 'Color',  'Estado', 'Opciones'],
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('generals::layouts.admin.entity-estatuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreatePaymentRequestStatusRequest $request)
    {
        $this->contractRequestStatusInterface
            ->createPaymentRequestStatus($request->except('_token', '_method'));

        return redirect()->route('admin.payment-request-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.payment-request-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdatePaymentRequestStatusRequest $request, $id)
    {
        $contractStatus = $this->contractRequestStatusInterface->findPaymentRequestStatusById($id);
        $update = new PaymentRequestStatusRepository($contractStatus);
        $update->updatePaymentRequestStatus($request->except('_token', '_method'));

        return redirect()->route('admin.payment-request-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->contractRequestStatusInterface->findPaymentRequestStatusById($id)->delete();

        return redirect()->route('admin.payment-request-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}
