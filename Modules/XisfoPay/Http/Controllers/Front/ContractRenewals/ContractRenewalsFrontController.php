<?php

namespace Modules\XisfoPay\Http\Controllers\Front\ContractRenewals;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Module\XisfoPay\Entities\ContractRenewals\Exceptions\UpdateContractRenewalErrorException;
use Modules\XisfoPay\Entities\ContractRenewals\Requests\CreateContractRenewalRequest;
use Modules\XisfoPay\Entities\ContractRenewals\Requests\UpdateContractRenewalRequest;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;

class ContractRenewalsFrontController extends Controller
{
    private $ContractRenewalServiceInterface;

    public function __construct(
        ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface
    ) {
        $this->ContractRenewalServiceInterface = $contractRenewalUseCaseInterface;
    }

    public function index(Request $request)
    {
        //
    }

    public function create()
    {
       //
    }

    public function store(CreateContractRenewalRequest $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function update(UpdateContractRenewalRequest $request, $id)
    {
        try {
            $this->ContractRenewalServiceInterface->updateContractRenewal($request, $id);
        } catch (UpdateContractRenewalErrorException $th) {
            return back()
                ->with('error', 'No se pudo actualizar la renovación');
        }

        return back()
            ->with('message', config('messaging.update'));
    }
}
