<?php

namespace Modules\PawnShop\Http\Controllers\Admin\FasecoldaPriceRates;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Requests\CreateFasecoldaPriceRateRequest;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Requests\UpdateFasecoldaPriceRateRequest;
use Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases\Interfaces\FasecoldaPriceRateUseCaseInterface;

class FasecoldaPriceRatesController extends Controller
{
    private $fasecoldaPriceRateServiceInterface;

    public function __construct(
        FasecoldaPriceRateUseCaseInterface $fasecoldaPriceRateUseCaseInterface
    ) {
        $this->middleware(['permission:fasecolda_price_rates, guard:employee']);
        $this->fasecoldaPriceRateServiceInterface = $fasecoldaPriceRateUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->fasecoldaPriceRateServiceInterface->listFasecoldaPriceRates(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('pawnshop::admin.fasecolda-price-Rates.list', $response['data']);
    }

    public function create()
    {
        return view('pawnshop::admin.fasecolda-price-Rates.create', $this->fasecoldaPriceRateServiceInterface->createFasecoldaPriceRate());
    }

    public function store(CreateFasecoldaPriceRateRequest $request)
    {
        $this->fasecoldaPriceRateServiceInterface->storeFasecoldaPriceRate($request->except('_token', '_method'));

        return redirect()->route('admin.fasecolda-price-Rates.index')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateFasecoldaPriceRateRequest $request, $id)
    {
        $this->fasecoldaPriceRateServiceInterface->updateFasecoldaPriceRate($request, $id);

        return redirect()->route('admin.fasecolda-price-rates.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->fasecoldaPriceRateServiceInterface->destroyFasecoldaPriceRate($id);

        return redirect()->route('admin.fasecolda-price-Rates.index')
            ->with('message', config('messaging.delete'));
    }
}
