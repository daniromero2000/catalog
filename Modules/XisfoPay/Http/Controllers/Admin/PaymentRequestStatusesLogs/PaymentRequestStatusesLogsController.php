<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentRequestStatusesLogs;

use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces\PaymentRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Requests\CreatePaymentRequestStatusesLogRequest;

class PaymentRequestStatusesLogsController extends Controller
{
    private $contractStatusLogInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentRequestStatusesLogRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:payment_requests, guard:employee']);
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->contractStatusLogInterface = $contractStatusRepositoryInterface;
    }

    public function store(CreatePaymentRequestStatusesLogRequest $request)
    {
        $this->contractStatusLogInterface
            ->createPaymentRequestStatusesLog($request->except('_token', '_method'));

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show()
    {
        return view('generals::layouts.error.404');
    }
}
