<?php

namespace Modules\Fasecolda\Http\Controllers\Admin\FasecoldaPrices;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\Exceptions\CreateFasecoldaPriceErrorException;
use Modules\Fasecolda\Entities\FasecoldaPrices\Requests\CreateFasecoldaPriceRequest;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces\FasecoldaPriceUseCaseInterface;

class FasecoldaPricesController extends Controller
{
    private $fasecoldaPriceServiceInterface, $fasecoldaCodeServiceInterface;

    public function __construct(
        FasecoldaPriceUseCaseInterface $fasecoldaPriceUseCaseInterface,
        FasecoldaCodeUseCaseInterface $fasecoldaCodeUseCaseInterface
    ) {
        $this->fasecoldaPriceServiceInterface = $fasecoldaPriceUseCaseInterface;
        $this->fasecoldaCodeServiceInterface = $fasecoldaCodeUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->fasecoldaCodeServiceInterface->listFasecoldaCodes(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('fasecolda::admin.fasecolda-codes.list', $response['data']);
    }

    public function create()
    {
        return view('fasecolda::layouts.fasecolda.load_file', $this->fasecoldaPriceServiceInterface->createFasecoldaPrice());
    }

    public function store(CreateFasecoldaPriceRequest $request)
    {
        $this->fasecoldaPriceServiceInterface->storeFasecoldaPrice($request->file('file'));
        return redirect()->route('admin.fasecolda-codes.index')->with('message', 'Carga Exitosa');
    }
}
