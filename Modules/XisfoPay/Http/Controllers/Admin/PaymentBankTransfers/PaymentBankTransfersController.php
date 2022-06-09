<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PaymentBankTransfers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Requests\CreatePaymentBankTransferRequest;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Requests\UpdatePaymentBankTransferRequest;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces\PaymentBankTransferUseCaseInterface;

class PaymentBankTransfersController extends Controller
{
    private $paymentBankTransferServiceInterface;

    public function __construct(
        PaymentBankTransferUseCaseInterface $paymentBankTransferUseCaseInterface
    ) {
        $this->middleware(['permission:payment_bank_transfers, guard:employee']);
        $this->paymentBankTransferServiceInterface = $paymentBankTransferUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->paymentBankTransferServiceInterface->listPaymentBankTransfers(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.payment-bank-transfers.list', $response['data']);
    }

    public function listToConfirm()
    {
        $response = $this->paymentBankTransferServiceInterface->listPaymentBankTransfersToConfirm();

        return view('xisfopay::admin.payment-bank-transfers.confirm-transfers', $response['data']);
    }

    public function confirmTransfers(Request $request)
    {
        $this->paymentBankTransferServiceInterface->confirmTranfers($request);
        return back()->with('message', config('messaging.update'));
    }

    public function store(CreatePaymentBankTransferRequest $request)
    {
        $this->paymentBankTransferServiceInterface->storeBankTransfer($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.create'));
    }

    public function registerTokenAdvanceTransfer(CreatePaymentBankTransferRequest $request)
    {
        $this->paymentBankTransferServiceInterface->registerTokenAdvanceBankTransfer($request);
        return back()
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.payment-bank-transfers.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdatePaymentBankTransferRequest $request, int $id)
    {
        $this->paymentBankTransferServiceInterface->updateBankTransfer($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->paymentBankTransferServiceInterface->destroyBankTransfer($id);
        return redirect()->route('admin.payment-bank-transfers.index')
            ->with('message', config('messaging.delete'));
    }
}
