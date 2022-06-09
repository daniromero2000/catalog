<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRates;

use Modules\XisfoPay\Entities\ContractRates\Requests\CreateContractRateRequest;
use Modules\XisfoPay\Entities\ContractRates\Requests\UpdateContractRateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\XisfoPay\Entities\ContractRates\UseCases\Interfaces\ContractRateUseCaseInterface;

class ContractRatesController extends Controller
{
    private $contractRateServiceInterface;

    public function __construct(
        ContractRateUseCaseInterface $contractRateUseCaseInterface
    ) {
        $this->middleware(['permission:contract_rates, guard:employee']);
        $this->contractRateServiceInterface = $contractRateUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->contractRateServiceInterface->listContractRates(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.contract-rates.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.contract-rates.create');
    }

    public function store(CreateContractRateRequest $request)
    {
        $this->contractRateServiceInterface->storeContractRate($request->except('_token', '_method'));

        return redirect()->route('admin.contract-rates.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.contract-rates.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateContractRateRequest $request, int $id)
    {
        $this->contractRateServiceInterface->updateContractRate($request->except('_token', '_method'), $id);

        return redirect()->route('admin.contract-rates.index')->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->contractRateServiceInterface->destroycontractRate($id);

        return redirect()->route('admin.contract-rates.index')
            ->with('message', config('messaging.delete'));
    }
}
