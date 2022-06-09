<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentRequests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentRequests\Requests\ApprovePaymentRequestRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Requests\CreatePaymentRequestRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Requests\UpdatePaymentRequestRequest;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;

class PaymentRequestsController extends Controller
{
    private $paymentRequestServiceInterface;

    public function __construct(
        PaymentRequestUseCaseInterface $paymentRequestUseCaseInterface
    ) {
        $this->middleware(['permission:payment_requests, guard:employee']);
        $this->paymentRequestServiceInterface = $paymentRequestUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->paymentRequestServiceInterface->listPaymentRequests(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.payment-requests.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.payment-requests.create', $this->paymentRequestServiceInterface->createPaymentRequest());
    }

    public function store(CreatePaymentRequestRequest $request)
    {
        $paymentRequest = $this->paymentRequestServiceInterface->storePaymentRequest($request);

        return redirect()->route('admin.payment-requests.show', $paymentRequest->id)
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $paymentRequest =  $this->paymentRequestServiceInterface->showPaymentRequest($id);

        return view('xisfopay::admin.payment-requests.show', $paymentRequest);
    }

    public function update(UpdatePaymentRequestRequest $request, $id)
    {
        $this->paymentRequestServiceInterface->updatePaymentRequest($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->paymentRequestServiceInterface->destroyPaymentRequest($id);

        return redirect()->route('admin.payment-requests.index')
            ->with('message', config('messaging.delete'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->paymentRequestServiceInterface->removePaymentRequestThumbnail($request->src);
        return back()->with('message', config('messaging.delete'));
    }

    public function addPaymentRequestToCut(Request $request)
    {
        $this->paymentRequestServiceInterface->addPaymentRequestToCut($request->except(['_token', '_method']));
        return back()->with('message', 'Agregado existosamente');
    }

    public function pendingPaymentRequests()
    {
        $response = $this->paymentRequestServiceInterface->pendingPaymentRequests();

        return view('xisfopay::admin.payment-requests.pending_payment_requests', $response);
    }

    public function approvePaymentRequests(ApprovePaymentRequestRequest $request)
    {
        $this->paymentRequestServiceInterface->approvePaymentRequests($request->except(['_token', '_method']));
        return back()->with('message', 'Se han asignado y aprobado los pagos');
    }
}
