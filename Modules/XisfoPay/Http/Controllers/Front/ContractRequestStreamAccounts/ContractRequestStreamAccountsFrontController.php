<?php

namespace Modules\XisfoPay\Http\Controllers\Front\ContractRequestStreamAccounts;

use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Requests\CreateContractRequestStreamAccountRequest;
use Illuminate\Routing\Controller;

class ContractRequestStreamAccountsFrontController extends Controller
{
    private $contractRequestStreamAccountInterface;

    public function __construct(
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface
    ) {
        $this->contractRequestStreamAccountInterface = $contractRequestStreamAccountRepositoryInterface;
    }

    public function store(CreateContractRequestStreamAccountRequest $request)
    {
        $this->contractRequestStreamAccountInterface->createContractRequestStreamAccount($request->except('_token', '_method'));
        return back()
            ->with('message', 'Plataforma Cliente Creada Exitosamente!');
    }
}
