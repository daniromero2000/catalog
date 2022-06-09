<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRenewals;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Module\XisfoPay\Entities\ContractRenewals\Exceptions\CreateContractRenewalException;
use Module\XisfoPay\Entities\ContractRenewals\Exceptions\DeletingContractRenewalException;
use Module\XisfoPay\Entities\ContractRenewals\Exceptions\UpdateContractRenewalErrorException;
use Modules\XisfoPay\Entities\ContractRenewals\Requests\CreateContractRenewalRequest;
use Modules\XisfoPay\Entities\ContractRenewals\Requests\UpdateContractRenewalRequest;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;

class ContractRenewalsController extends Controller
{
    private $ContractRenewalServiceInterface;

    public function __construct(
        ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface
    ) {
        $this->middleware(['permission:contracts|contract_requests, guard:employee']);
        $this->ContractRenewalServiceInterface = $contractRenewalUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->ContractRenewalServiceInterface->listContractRenewals(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.contract-renewals.list', $response['data']);
    }

    public function create()
    {
        return redirect()->route('admin.contract-renewals.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(CreateContractRenewalRequest $request)
    {
        $this->ContractRenewalServiceInterface->storeContractRenewal($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.contract-renewals.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateContractRenewalRequest $request, $id)
    {
        $this->ContractRenewalServiceInterface->updateContractRenewal($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->ContractRenewalServiceInterface->destroyContractRenewal($id);
        return back()->with('message', config('messaging.deleted'));
    }
}
