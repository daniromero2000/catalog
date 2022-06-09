<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentRequestCommentaries;

use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepository;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories\Interfaces\PaymentRequestCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Requests\CreatePaymentRequestCommentaryRequest;

class PaymentRequestCommentariesController extends Controller
{
    private $contractStatusInterface;

    public function __construct(
        PaymentRequestCommentaryRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:payment_requests, guard:employee']);
        $this->contractStatusInterface = $contractStatusRepositoryInterface;
    }

    public function store(CreatePaymentRequestCommentaryRequest $request)
    {
        $user = ToolRepository::setStaticSignedUser();
        $request['user'] = $user->name . ' ' . $user->last_name;
        $this->contractStatusInterface->createPaymentRequestCommentary($request->except('_token', '_method'));

        return redirect()->route('admin.payment-requests.show', $request->payment_request_id)
            ->with('message', config('messaging.create'));
    }

    public function show()
    {
        return view('generals::layouts.error.404');
    }
}
