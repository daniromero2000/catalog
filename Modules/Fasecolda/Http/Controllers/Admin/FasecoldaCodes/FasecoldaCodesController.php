<?php

namespace Modules\Fasecolda\Http\Controllers\Admin\FasecoldaCodes;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Fasecolda\Entities\FasecoldaCodes\Exceptions\CreateFasecoldaCodeErrorException;
use Modules\Fasecolda\Entities\FasecoldaCodes\Requests\CreateFasecoldaCodeRequest;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;

class FasecoldaCodesController extends Controller
{
    private $fasecoldaCodeServiceInterface;

    public function __construct(
        FasecoldaCodeUseCaseInterface $fasecoldaCodeUseCaseInterface
    ) {
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
        return view('fasecolda::layouts.fasecolda.load_file', $this->fasecoldaCodeServiceInterface->createFasecoldaCode());
    }

    public function store(CreateFasecoldaCodeRequest $request)
    {
        $this->fasecoldaCodeServiceInterface->storeFasecoldaCode($request->file('file'));
        return redirect()->route('admin.fasecolda-codes.index')->with('message', 'Carga Exitosa');
    }
}
