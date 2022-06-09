<?php

namespace Modules\PawnShop\Http\Controllers\Admin\JewelryQualities;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PawnShop\Entities\JewelryQualities\Requests\CreateJewelryQualityRequest;
use Modules\PawnShop\Entities\JewelryQualities\Requests\UpdateJewelryQualityRequest;
use Modules\PawnShop\Entities\JewelryQualities\UseCases\Interfaces\JewelryQualityUseCaseInterface;

class JewelryQualitiesController extends Controller
{
    private $jewelryQualityServiceInterface;

    public function __construct(
        JewelryQualityUseCaseInterface $jewelryQualityUseCaseInterface
    ) {
        //$this->middleware(['permission:fasecolda_price_rates, guard:employee']);
        $this->jewelryQualityServiceInterface = $jewelryQualityUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->jewelryQualityServiceInterface->listJewelryQualities(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('pawnshop::admin.jewelry-qualities.list', $response['data']);
    }

    public function create()
    {
        return view('pawnshop::admin.jewelry-qualities.create', $this->jewelryQualityServiceInterface->createJewelryQuality());
    }

    public function store(CreateJewelryQualityRequest $request)
    {
        $this->jewelryQualityServiceInterface->storeJewelryQuality($request->except('_token', '_method'));

        return redirect()->route('admin.jewelry-qualities.index')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateJewelryQualityRequest $request, $id)
    {
        $this->jewelryQualityServiceInterface->updateJewelryQuality($request, $id);

        return redirect()->route('admin.jewelry-qualities.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->jewelryQualityServiceInterface->destroyJewelryQuality($id);

        return redirect()->route('admin.jewelry-qualities.index')
            ->with('message', config('messaging.delete'));
    }
}
