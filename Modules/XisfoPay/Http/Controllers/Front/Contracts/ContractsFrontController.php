<?php

namespace Modules\XisfoPay\Http\Controllers\Front\Contracts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\Contracts\Exceptions\ContractNotFoundException;
use Modules\XisfoPay\Entities\Contracts\UseCases\Interfaces\ContractUseCaseInterface;

class ContractsFrontController extends Controller
{
    private $contractServiceInterface;

    public function __construct(
        ContractUseCaseInterface $contractUseCaseInterface
    ) {
        $this->middleware('ContractIsOwner', ['only' => ['show']]);
        $this->contractServiceInterface  = $contractUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->contractServiceInterface->listCustomerContracts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::front.contracts.list', $response['data']);
    }

    public function show($id)
    {
        try {
            $contract = $this->contractServiceInterface->showContract($id);
        } catch (ContractNotFoundException $e) {
            return redirect()->route('account.contracts.index')
                ->with('error', 'No se encuentra lo que estás Buscando');
        }

        return view('xisfopay::front.contracts.show', $contract);
    }
}
