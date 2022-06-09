<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelBannedCountries;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelBannedCountries\UseCases\Interfaces\CammodelBannedCountryUseCaseInterface;

class CammodelBannedCountryController extends Controller
{
    private $cammodelBannedCountryServiceInterface;

    public function __construct(
        CammodelBannedCountryUseCaseInterface $cammodelBannedCountryUseCaseInterface
    ) {
        $this->cammodelBannedCountryServiceInterface = $cammodelBannedCountryUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelBannedCountryServiceInterface->listCammodelBannedCountries(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-banned-countries.list', $response['data']);
    }

    public function show(int $cammodelBannedCountryId)
    {
        return redirect()->route('admin.cammodel-banned-countries.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(Request $request)
    {
        $this->cammodelBannedCountryServiceInterface->storeCammodelBannedCountry($request->except('_token', '_method'));
        return back()->with('message', config('messaging.create'));
    }
}
