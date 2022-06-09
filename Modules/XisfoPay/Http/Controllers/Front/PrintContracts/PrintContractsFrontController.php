<?php

namespace Modules\XisfoPay\Http\Controllers\Front\PrintContracts;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;
use NumberFormatter;

class PrintContractsFrontController extends Controller
{
    private $contractRequestInterface, $contractRenewalServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface
    ) {
        $this->middleware('ContractRequestIsOwner');
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->contractRequestInterface   = $contractRequestRepositoryInterface;
        $this->contractRenewalServiceInterface = $contractRenewalUseCaseInterface;
    }

    public function generateContract(int $id)
    {
        $contract_request = $this->contractRequestInterface->findContractRequestById($id);
        setlocale(LC_ALL, 'es_ES');
        //   $fecha = Carbon::now();
        $fecha = $contract_request->contract->contractRenewals->where('is_active', 1)->first()->starts;
        $fecha->format("F");

        $data = [
            'contract_request'   => $contract_request,
            'year'               => $fecha->year,
            'day'                => $fecha->day,
            'day_word'           => $fecha->day,
            'mes'                => $fecha->formatLocalized('%B'),
            'fecha'              => $fecha,
            'contract_rate_word' => $contract_request->contract->contractRenewals->where('is_active', 1)->first()->contractRate->percentage
        ];

        $pdf = app()->make('dompdf.wrapper');
        if ($contract_request->customerCompany->constitution_type == 'Jurídica') {
            $pdf->loadView('xisfopay::admin.print-contracts.contract_juridico', $data)->stream();
        } else {
            $pdf->loadView('xisfopay::admin.print-contracts.contract_natural', $data)->stream();
        }

        //$this->contractRenewalServiceInterface->setRenewalDates($contract_request->contract->contractRenewals->where('is_active', 1)->first()->id);

        return $pdf->download('CONTRATO CLIENTE' . ' ' . $contract_request->client_identifier . '.pdf');
    }
}
