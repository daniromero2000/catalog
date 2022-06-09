<?php

namespace Modules\XisfoPay\Http\Controllers\Front\PaymentRequests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentRequests\Requests\CreatePaymentRequestRequest;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasCreated;

class PaymentRequestsFrontController extends Controller
{
    private $paymentRequestServiceInterface;

    public function __construct(
        PaymentRequestUseCaseInterface $paymentRequestUseCaseInterface
    ) {
        $this->paymentRequestServiceInterface = $paymentRequestUseCaseInterface;
        $this->middleware('PaymentRequestIsOwner', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $response = $this->paymentRequestServiceInterface->listCustomerPaymentRequests(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::front.payment-requests.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::front.payment-requests.create', $this->paymentRequestServiceInterface->createFromPaymentRequest());
    }

    public function store(CreatePaymentRequestRequest $request)
    {
        try {
            $paymentRequest = $this->paymentRequestServiceInterface->storePaymentRequest($request);
        } catch (CreatePaymentRequestErrorException $e) {
            return redirect()->route($e->getMessage())
                ->with('error', 'No se pudo crear el Pago');
        }

        event(new PaymentRequestWasCreated($paymentRequest));

        return redirect()->route('account.payment-requests.show', $paymentRequest->id)
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        try {
            $paymentRequest =  $this->paymentRequestServiceInterface->showPaymentRequest($id);
        } catch (PaymentRequestNotFoundException $e) {
            return redirect()->route($e->getMessage())
                ->with('error', 'No se encuentra el pago que estás buscando');
        }

        return view('xisfopay::front.payment-requests.show', $paymentRequest);
    }

    public function update(Request $request, $id)
    {
        $this->paymentRequestServiceInterface->updatePaymentRequest($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->paymentRequestServiceInterface->removePaymentRequestThumbnail($request->src);
        return back()->with('message', config('messaging.delete'));
    }
}
