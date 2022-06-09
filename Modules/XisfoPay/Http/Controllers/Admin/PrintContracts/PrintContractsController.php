<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\PrintContracts;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;
use NumberFormatter;

class PrintContractsController extends Controller
{
    private $contractRequestInterface, $contractRenewalServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface
    ) {
        $this->middleware(['permission:contract_requests, guard:employee']);
        $this->toolsInterface                  = $toolRepositoryInterface;
        $this->contractRequestInterface        = $contractRequestRepositoryInterface;
        $this->contractRenewalServiceInterface = $contractRenewalUseCaseInterface;
    }

    public function generateContract(int $id)
    {
        $contract_request = $this->contractRequestInterface->findContractRequestById($id);
        setlocale(LC_ALL, 'es_ES');
        //   $fecha = Carbon::now();
        $fecha = $contract_request->contract->contractRenewals->where('is_active', 1)->first()->starts;
        $fecha->format("F");
        $f = new NumberFormatter("es", NumberFormatter::SPELLOUT);

        $data = [
            'contract_request'   => $contract_request,
            'year'               => $fecha->year,
            'day'                => $fecha->day,
            'day_word'           => $f->format($fecha->day),
            'mes'                => $fecha->formatLocalized('%B'),
            'fecha'              => $fecha->format('Y-m-d'),
            'contract_rate_word' => $f->format($contract_request->contract->contractRenewals->where('is_active', 1)->first()->contractRate->percentage)
        ];

        $pdf = app()->make('dompdf.wrapper');
        switch ($contract_request->contract_request_type) {
            case 1:
                $pdf->loadView('xisfopay::admin.print-contracts.contract_juridico', $data)->stream();
                break;
            case 2:
                $pdf->loadView('xisfopay::admin.print-contracts.contract_natural', $data)->stream();
                break;
            case 3:
                $pdf->loadView('xisfopay::admin.print-contracts.contract_tokens', $data)->stream();
                break;
        }

        // $this->contractRenewalServiceInterface->setRenewalDates($contract_request->contract->contractRenewals->where('is_active', 1)->first()->id);

        return $pdf->stream();
    }
}
