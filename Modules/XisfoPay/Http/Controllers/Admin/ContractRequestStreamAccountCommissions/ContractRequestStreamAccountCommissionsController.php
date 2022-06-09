<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequestStreamAccountCommissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\CreateContractRequestStreamAccountCommissionErrorException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Requests\CreateContractRequestStreamAccountCommissionRequest;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Requests\UpdateContractRequestStreamAccountCommissionRequest;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases\Interfaces\ContractRequestStreamAccountCommissionUseCaseInterface;

class ContractRequestStreamAccountCommissionsController extends Controller
{
    private $contractRequestStreamAccountCommissionServiceInterface;

    public function __construct(
        ContractRequestStreamAccountCommissionUseCaseInterface $contractRequestStreamAccountCommissionUseCaseInterface
    ) {
        $this->middleware(['permission:contract_request_stream_account_commissions, guard:employee']);
        $this->contractRequestStreamAccountCommissionServiceInterface = $contractRequestStreamAccountCommissionUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->contractRequestStreamAccountCommissionServiceInterface->listContractRequestStreamAccountCommissions(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.contract-request-stream-account-commissions.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.contract-request-stream-account-commissions.create', $this->contractRequestStreamAccountCommissionServiceInterface->createContractRequestStreamAccountCommission());
    }

    public function store(CreateContractRequestStreamAccountCommissionRequest $request)
    {
        try {
            $this->contractRequestStreamAccountCommissionServiceInterface->storeContractRequestStreamAccountCommission($request->except('_token', '_method'));
        } catch (CreateContractRequestStreamAccountCommissionErrorException $th) {
            return back()->with('error', 'No se pudo guardar la transferencia de plataforma');
        }

        return redirect()->route('admin.stream-account-commissions.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return view('xisfopay::admin.contract-request-stream-account-commissions.show', $this->contractRequestStreamAccountCommissionServiceInterface->showContractRequestStreamAccountCommission($id));
    }

    public function update(UpdateContractRequestStreamAccountCommissionRequest $request, int $id)
    {
        $this->contractRequestStreamAccountCommissionServiceInterface->updateContractRequestStreamAccountCommission($request->except('_token', '_method'), $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->contractRequestStreamAccountCommissionServiceInterface->destroyContractRequestStreamAccountCommission($id);

        return redirect()->route('admin.stream-account-commissions.index')
            ->with('message', config('messaging.delete'));
    }
}
