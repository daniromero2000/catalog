<?php

namespace Modules\XisfoPay\Http\Controllers\Front\ContractRequests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\ContractRequestNotFoundException;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\CreateContractRequestErrorException;
use Modules\XisfoPay\Entities\ContractRequests\Requests\CreateFrontContractRequestRequest;
use Modules\XisfoPay\Entities\ContractRequests\Requests\CreateNewContractRequestRequest;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces\ContractRequestUseCaseInterface;

class ContractRequestsFrontController extends Controller
{
    private $contractRequestServiceInterface;

    public function __construct(
        ContractRequestUseCaseInterface $contractRequestUseCaseInterface
    ) {
        $this->middleware('ContractRequestIsOwner', ['only' => ['show']]);
        $this->contractRequestServiceInterface = $contractRequestUseCaseInterface;
    }

    public function index()
    {
        $response = $this->contractRequestServiceInterface->listCustomerContractRequests();

        return view('xisfopay::front.contract-requests.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::front.contract-requests.create', $this->contractRequestServiceInterface->createFrontContractRequest());
    }

    public function createNew()
    {
        return view('xisfopay::front.contract-requests.create-client-dashboard', $this->contractRequestServiceInterface->createNewFrontContractRequest());
    }

    public function store(CreateFrontContractRequestRequest $request)
    {
        try {
            $data = $this->contractRequestServiceInterface->storeFrontContractRequest($request);
        } catch (CreateContractRequestErrorException $e) {
            return back()->with('error', 'No se pudo crear la Solicitud');
        }

        return view('xisfopay::front.customers.notification.notification-create', [
            'company_legal_name' => $data['company_legal_name'],
            'customer_mail'      => $data['customer_email'],
        ])->with('message', config('Creación de cuenta exitosa'));
    }

    public function storeNew(CreateNewContractRequestRequest $request)
    {
        try {
            $contractRequest = $this->contractRequestServiceInterface->storeNewFrontContractRequest($request);
        } catch (CreateContractRequestErrorException $e) {
            return back()->with('error', 'No se pudo crear la Solicitud');
        }

        return redirect()->route('account.contract-requests.show', $contractRequest->id)
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        try {
            $contractRequest =  $this->contractRequestServiceInterface->showContractRequest($id);
        } catch (ContractRequestNotFoundException $e) {
            return redirect()->route('account.contract-requests.index')
                ->with('error', config('messaging.not_found'));
        }

        return view('xisfopay::front.contract-requests.show', $contractRequest);
    }

    public function edit($id)
    {
        return redirect()->route('account.contract-requests.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->contractRequestServiceInterface->updateContractRequest($request, $id);
        } catch (UpdateContractErrorException $e) {
            return redirect()->route('account.contract-requests.index')
                ->with('error', 'No se pudo actualizar la Solicitud');
        }

        return back()
            ->with('message', config('messaging.update'));
    }
}
