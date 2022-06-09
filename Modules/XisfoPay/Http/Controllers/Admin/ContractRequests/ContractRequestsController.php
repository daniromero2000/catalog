<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequests\Requests\CreateContractRequestRequest;
use Modules\XisfoPay\Entities\ContractRequests\Requests\CreateNewContractRequestRequest;
use Modules\XisfoPay\Entities\ContractRequests\Requests\UpdateContractRequestRequest;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces\ContractRequestUseCaseInterface;

class ContractRequestsController extends Controller
{
    private $contractRequestServiceInterface;

    public function __construct(
        ContractRequestUseCaseInterface $contractRequestUseCaseInterface
    ) {
        $this->middleware(['permission:contract_requests, guard:employee']);
        $this->contractRequestServiceInterface            = $contractRequestUseCaseInterface;
        $this->module                                     = 'Solicitudes de Contrato';
    }

    public function index(Request $request)
    {
        $response = $this->contractRequestServiceInterface->listContractRequests(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.contract-requests.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.contract-requests.create', $this->contractRequestServiceInterface->createContractRequest());
    }

    public function createNew(int $id)
    {
        return view('xisfopay::layouts.contract_requests.admin.create-new-contract-request', $this->contractRequestServiceInterface->createNewContractRequest($id));
    }

    public function store(CreateContractRequestRequest $request)
    {
        $contractRequest = $this->contractRequestServiceInterface->storeContractRequest($request);
        return redirect()->route('admin.contract-requests.show', $contractRequest->id)
            ->with('message', config('messaging.create'));
    }

    public function storeNew(CreateNewContractRequestRequest $request, int $id)
    {
        $contractRequest = $this->contractRequestServiceInterface->storeNewContractRequest($request, $id);

        return redirect()->route('admin.contract-requests.show', $contractRequest->id)
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $contractRequest =  $this->contractRequestServiceInterface->showContractRequest($id);

        return view('xisfopay::admin.contract-requests.show', $contractRequest);
    }

    public function edit($id)
    {
        return redirect()->route('admin.contract-requests.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateContractRequestRequest $request, $id)
    {
        $this->contractRequestServiceInterface->updateContractRequest($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->contractRequestServiceInterface->destroyContractRequest($id);

        return redirect()->route('admin.contract-requests.index')
            ->with('message', config('messaging.delete'));
    }
}
