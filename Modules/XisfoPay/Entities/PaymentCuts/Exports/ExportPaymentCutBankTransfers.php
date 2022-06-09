<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportPaymentCutBankTransfers implements FromView
{
    use Exportable;

    public function forId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function view(): View
    {
        $paymentCut = PaymentCut::query()->with('paymentRequestsForExport')->where('id', $this->id)->first();
        $paymentRequests =  $paymentCut->paymentRequestsForExport;

        return view('xisfopay::admin.payment-cuts.export_payment_cut_bank_transfers', [
            'paymentRequests' => $paymentRequests
        ]);
    }
}
