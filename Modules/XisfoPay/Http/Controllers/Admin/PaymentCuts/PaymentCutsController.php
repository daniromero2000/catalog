<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentCuts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentCuts\Exports\ExportPaymentCut;
use Modules\XisfoPay\Entities\PaymentCuts\Exports\ExportPaymentCutBankTransfers;
use Modules\XisfoPay\Entities\PaymentCuts\Requests\CreatePaymentCutRequest;
use Modules\XisfoPay\Entities\PaymentCuts\Requests\UpdatePaymentCutRequest;
use Modules\XisfoPay\Entities\PaymentCuts\UseCases\Interfaces\PaymentCutUseCaseInterface;

class PaymentCutsController extends Controller
{
    private $paymentCutServiceInterface;

    public function __construct(
        PaymentCutUseCaseInterface $paymentCutUseCaseInterface
    ) {
        $this->middleware(['permission:payment_cuts, guard:employee']);
        $this->paymentCutServiceInterface = $paymentCutUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->paymentCutServiceInterface->listPaymentCuts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.payment-cuts.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.payment-cuts.create', $this->paymentCutServiceInterface->createPaymentCut());
    }

    public function store(CreatePaymentCutRequest $request)
    {
        $this->paymentCutServiceInterface->storePaymentCut($request->except('_token', '_method'));

        return redirect()->route('admin.payment-cuts.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $payment_cut =  $this->paymentCutServiceInterface->showPaymentCut($id);

        return view('xisfopay::admin.payment-cuts.show', $payment_cut);
    }

    public function update(UpdatePaymentCutRequest $request, int $id)
    {
        $this->paymentCutServiceInterface->updatePaymentCut($request->except('_token', '_method'), $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->paymentCutServiceInterface->destroyPaymentCut($id);

        return redirect()->route('admin.payment-cuts.index')
            ->with('message', config('messaging.delete'));
    }

    public function exportPaymentCut($id)
    {
        $nombre =  $this->paymentCutServiceInterface->exportPaymentCut($id);
        return (new ExportPaymentCut)->forId($id)->download($nombre);
    }

    public function exportPaymentCutBankTransfers($id)
    {
        $nombre = $this->paymentCutServiceInterface->exportPaymentCutBankTransfers($id);
        return (new ExportPaymentCutBankTransfers)->forId($id)->download($nombre);
    }

    public function reCalculatePaymentCut($id)
    {
        $this->paymentCutServiceInterface->reCalculatePaymentCut($id);
        return back()->with('message', 'Liquidación exitosa');
    }
}
