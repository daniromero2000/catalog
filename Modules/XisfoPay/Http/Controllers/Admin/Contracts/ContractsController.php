<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\Contracts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\Contracts\Requests\CreateContractRequest;
use Modules\XisfoPay\Entities\Contracts\Requests\UpdateContractRequest;
use Modules\XisfoPay\Entities\Contracts\UseCases\Interfaces\ContractUseCaseInterface;

class ContractsController extends Controller
{
    private $contractServiceInterface;

    public function __construct(
        ContractUseCaseInterface $contractUseCaseInterface
    ) {
        $this->middleware(['permission:contract_requests|contracts, guard:employee']);
        $this->contractServiceInterface = $contractUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->contractServiceInterface->listContracts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.contracts.list', $response['data']);
    }

    public function create()
    {
        return redirect()->route('admin.contracts.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(CreateContractRequest $request)
    {
        $contract = $this->contractServiceInterface->storeContract($request);

        return redirect()->route('admin.contracts.show', $contract->id)
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $contract =  $this->contractServiceInterface->showContract($id);

        return view('xisfopay::admin.contracts.show', $contract);
    }

    public function update(UpdateContractRequest $request, $id)
    {
        $contract = $this->contractServiceInterface->updateContract($request, $id);

        return redirect()->route('admin.contracts.show', $contract->id)
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->contractServiceInterface->destroyContract($id);

        return redirect()->route('admin.contracts.index')
            ->with('message', config('messaging.delete'));
    }
}
