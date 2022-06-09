<?php

namespace Modules\XisfoPay\Http\Controllers\Front\PrintContractRequests;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PrintContractRequestsFrontController extends Controller
{
    private $contractRequestInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        CustomerIdentityRepositoryInterface $customerIdentityRepositoryInterface
    ) {
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->customerInterface          = $customerRepositoryInterface;
        $this->contractRequestInterface   = $contractRequestRepositoryInterface;
        $this->cityInterface              = $cityRepositoryInterface;
        $this->customerIdentityInterface = $customerIdentityRepositoryInterface;
        $this->middleware('ContractRequestIsOwner');
    }

    public function export($id)
    {
        $contract_request = $this->contractRequestInterface->findContractRequestById($id);
        $fecha = Carbon::now();
        $fecha->format("F");
        $data = [
            'contract_request'   => $contract_request,
            'fecha'              => $fecha->format('Y-m-d')
        ];
        $pdf = app()->make('dompdf.wrapper');
        if ($contract_request->customerCompany->constitution_type == 'Jurídica') {
            $pdf->loadView('xisfopay::admin.print-contract-requests.contract_request_juridico', $data)->stream();
        } else {
            $pdf->loadView('xisfopay::admin.print-contract-requests.contract_request_natural', $data)->stream();
        }
        return $pdf->download('SOLICITUD CLIENTE'. ' ' . $contract_request->client_identifier.'.pdf');
    }
}
