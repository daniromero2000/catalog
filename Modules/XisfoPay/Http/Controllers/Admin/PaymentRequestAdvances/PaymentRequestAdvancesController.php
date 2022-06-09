<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentRequestAdvances;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\PaymentRequestAdvanceNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\CreatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\UpdatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Requests\CreatePaymentRequestAdvanceRequest;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Requests\UpdatePaymentRequestAdvanceRequest;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;

class PaymentRequestAdvancesController extends Controller
{
    private $paymentRequestAdvanceServiceInterface;

    public function __construct(
        PaymentRequestAdvanceUseCaseInterface $paymentRequestAdvanceUseCaseInterface
    ) {
        $this->middleware(['permission:payment_advance_requests, guard:employee']);
        $this->paymentRequestAdvanceServiceInterface = $paymentRequestAdvanceUseCaseInterface;
        $this->module                                = 'Avances Solicitud de Pago';
    }

    public function index(Request $request)
    {
        $response = $this->paymentRequestAdvanceServiceInterface->listPaymentRequestAdvances(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.payment-request-advances.list', $response['data']);
    }

    public function create()
    {
        return redirect()->route('admin.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(CreatePaymentRequestAdvanceRequest $request)
    {
        $this->paymentRequestAdvanceServiceInterface->storePaymentRequestAdvance($request);
        return back()
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $paymentRequest =  $this->paymentRequestAdvanceServiceInterface->showPaymentRequestAdvance($id);

        return view('xisfopay::admin.payment-request-advances.show', $paymentRequest);
    }

    public function update(UpdatePaymentRequestAdvanceRequest $request, $id)
    {
        $this->paymentRequestAdvanceServiceInterface->updatePaymentRequestAdvance($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->paymentRequestAdvanceServiceInterface->destroyPaymentRequestAdvance($id);

        return redirect()->route('admin.payment-request-advances.index')
            ->with('message', config('messaging.delete'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->paymentRequestAdvanceServiceInterface->removePaymentRequestAdvanceThumbnail($request->src);
        return back()->with('message', config('messaging.delete'));
    }
}
