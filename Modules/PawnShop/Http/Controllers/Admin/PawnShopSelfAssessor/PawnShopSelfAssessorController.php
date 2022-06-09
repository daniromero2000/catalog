<?php

namespace Modules\PawnShop\Http\Controllers\Admin\PawnShopSelfAssessor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces\FasecoldaPriceRateRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces\FasecoldaPriceUseCaseInterface;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces\JewelryQualityRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces\PawnItemCategoryRepositoryInterface;

class PawnShopSelfAssessorController extends Controller
{
    private $fasecoldaPricerateInterface, $pawnItemCategoryInterface;
    private $jewelryQualityRepo, $fasecoldaPriceServiceInterface;
    private $fasecoldaCodeServiceInterface;

    public function __construct(
        JewelryQualityRepositoryInterface $jewelryQualityRepository,
        FasecoldaCodeUseCaseInterface $fasecoldaCodeUseCaseInterface,
        FasecoldaPriceUseCaseInterface $fasecoldaPriceUseCaseRepositoryInterface,
        FasecoldaPriceRateRepositoryInterface $fasecoldaPriceRateRepositoryInterface,
        PawnItemCategoryRepositoryInterface $pawnItemCategoryInterface
    ) {
        $this->jewelryQualityRepo             = $jewelryQualityRepository;
        $this->pawnItemCategoryInterface      = $pawnItemCategoryInterface;
        $this->fasecoldaCodeServiceInterface  = $fasecoldaCodeUseCaseInterface;
        $this->fasecoldaPriceServiceInterface = $fasecoldaPriceUseCaseRepositoryInterface;
        $this->fasecoldaPricerateInterface    = $fasecoldaPriceRateRepositoryInterface;
        $this->module                         = 'AutoEvaluador';
    }

    public function index()
    {
        $fasecoldaClases = $this->fasecoldaCodeServiceInterface->getFasecoldaClases();
        $fasecoldaClases->values()->all();

        return view('pawnshop::admin.pawn-shop-self-assessor.create', [
            'jewelryQualities' => $this->jewelryQualityRepo->getAllJewelryQualityNames(),
            'itemCategories'   => $this->pawnItemCategoryInterface->getAllPawnItemCategoryNames(),
            'clases'           => $fasecoldaClases->sortBy('Clase'),
            'optionsRoutes'    =>  config('generals.optionRoutes'),
            'module'           => $this->module
        ]);
    }

    public function getBrands(Request $request)
    {
        return response()->json($this->fasecoldaCodeServiceInterface->findFasecoldaBrandsWithClase($request->input('clase')));
    }

    public function getReferences1(Request $request)
    {
        return response()->json($this->fasecoldaCodeServiceInterface->findreferences1WithMarca($request->input()));
    }

    public function getReferences2(Request $request)
    {
        return response()->json($this->fasecoldaCodeServiceInterface->findreferences2WithReference1($request->input()));
    }

    public function getReferences3(Request $request)
    {
        return response()->json($this->fasecoldaCodeServiceInterface->findreferences3WithReference2($request->input()));
    }

    public function getFasecoldaYearModels(Request $request)
    {
        return response()->json($this->fasecoldaCodeServiceInterface->findFasecoldaCodeWithReferences($request->input()));
    }

    public function getFasecoldaPrice(Request $request)
    {
        $fasecoldaPrice      = $this->fasecoldaPriceServiceInterface->findFasecoldaPrice($request->input());
        $fasecoldaPriceValue = $this->fasecoldaPricerateInterface->findFasecoldaPriceRateById(1);
        $price               = $fasecoldaPrice[0]['Valor'] * 1000 * $fasecoldaPriceValue->price;

        return response()->json(number_format($price));
    }

    public function getjewelryprice(Request $request)
    {
        $jewelryQualities = $this->jewelryQualityRepo->findJewelryQualityById($request->input('quality'));

        return response()->json(number_format($jewelryQualities->price * $request->input('weight')));
    }
}
