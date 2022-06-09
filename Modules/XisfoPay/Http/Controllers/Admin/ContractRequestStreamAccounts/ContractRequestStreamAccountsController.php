<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequestStreamAccounts;

use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Requests\CreateContractRequestStreamAccountRequest;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Requests\UpdateContractRequestStreamAccountRequest;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\Interfaces\ContractRequestStreamAccountUseCaseInterface;

class ContractRequestStreamAccountsController extends Controller
{
    private $contractRequestStreamAccountInterface, $toolsInterface, $contractRequestsInterface, $streamingInterface;
    private $contractRequestStreamAccountServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRequestStreamAccountUseCaseInterface $contractRequestStreamAccountUseCaseInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface
    ) {
        $this->middleware(['permission:contract_request_stream_accounts, guard:employee']);
        $this->contractRequestStreamAccountServiceInterface = $contractRequestStreamAccountUseCaseInterface;
        $this->contractRequestStreamAccountInterface        = $contractRequestStreamAccountRepositoryInterface;
        $this->toolsInterface                               = $toolRepositoryInterface;
        $this->contractRequestsInterface                    = $contractRequestRepositoryInterface;
        $this->streamingInterface                           = $streamingRepositoryInterface;
        $this->module                                       = 'Plataformas Cliente';
    }

    public function index(Request $request)
    {
        $response = $this->contractRequestStreamAccountServiceInterface
            ->listContractRequestStreamAccount(['search' => $request->input()]);

        return view('xisfopay::admin.contract-request-stream-accounts.list', $response['data']);
    }

    public function show(int $id)
    {
        return redirect()->route('admin.contract-request-stream-accounts.index')
            ->with('error', config('messaging.not_found'));
    }

    public function create()
    {
        $response = $this->contractRequestStreamAccountServiceInterface->createContractRequestStreamAccount();
        return view('xisfopay::admin.contract-request-stream-accounts.create', $response['data']);
    }

    public function store(CreateContractRequestStreamAccountRequest $request)
    {
        $this->contractRequestStreamAccountServiceInterface->storeContractRequestStreamAccount($request);
        return back()
            ->with('message', 'Plataforma Cliente Creada Exitosamente!');
    }

    public function edit(int $id)
    {
        return back();
    }

    public function update(UpdateContractRequestStreamAccountRequest $request, $id)
    {
        $this->contractRequestStreamAccountServiceInterface->updateContractRequestStreamAccount($request, $id);
        return back();
    }

    public function destroy(int $id)
    {
        $this->contractRequestStreamAccountServiceInterface->deleteContractRequestStreamAccount($id);

        return redirect()->route('admin.contract-request-stream-accounts.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }
}
