<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\CamStudio\Entities\CammodelPayrolls\CammodelPayroll;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportCammodelPayrollBankTransfers implements FromView
{
    use Exportable;

    public function forId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function view(): View
    {
        $cammodelPayroll = CammodelPayroll::query()->with('cammodelStreamingIncomesForExport')->where('id', $this->id)->first();
        $cammodelStreamingIncomes =  $cammodelPayroll->cammodelStreamingIncomesForExport;

        return view('camstudio::admin.cammodel-payrolls.export_cammodel_payroll_bank_transfers', [
            'cammodelStreamingIncomes' => $cammodelStreamingIncomes
        ]);
    }
}
