<?php

namespace Modules\XisfoPay\Http\Controllers\Front\PaymentBankTransfers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces\PaymentBankTransferUseCaseInterface;

class PaymentBankTransfersFrontController extends Controller
{
    private $paymentBankTransferServiceInterface;

    public function __construct(
        PaymentBankTransferUseCaseInterface $paymentBankTransferServiceInterface
    ) {
        $this->paymentBankTransferServiceInterface = $paymentBankTransferServiceInterface;
    }

    public function index(Request $request)
    {
        $response = $this->paymentBankTransferServiceInterface->listCustomerPaymentBankTransfers(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::front.payment-bank-transfers.list', $response['data']);
    }
}
