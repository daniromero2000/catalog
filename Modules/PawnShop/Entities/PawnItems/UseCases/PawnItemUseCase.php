<?php

namespace Modules\PawnShop\Entities\PawnItems\UseCases;

use Carbon\Carbon;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces\FasecoldaPriceUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces\FasecoldaPriceRateRepositoryInterface;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces\JewelryQualityRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces\PawnItemCategoryRepositoryInterface;
use Modules\PawnShop\Entities\PawnItems\Repositories\Interfaces\PawnItemRepositoryInterface;
use Modules\PawnShop\Entities\PawnItems\Repositories\PawnItemRepository;
use Modules\PawnShop\Entities\PawnItems\UseCases\Interfaces\PawnItemUseCaseInterface;

class PawnItemUseCase implements PawnItemUseCaseInterface
{
    private $pawnItemRepositoryInterface, $toolsInterface, $module;

    public function __construct(
        PawnItemRepositoryInterface $pawnItemRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        JewelryQualityRepositoryInterface $jewelryQualityRepository,
        FasecoldaCodeUseCaseInterface $fasecoldaCodeUseCaseInterface,
        FasecoldaPriceUseCaseInterface $fasecoldaPriceUseCaseRepositoryInterface,
        FasecoldaPriceRateRepositoryInterface $fasecoldaPriceRateRepositoryInterface,
        PawnItemCategoryRepositoryInterface $pawnItemCategoryInterface
    ) {
        $this->pawnItemRepositoryInterface          = $pawnItemRepositoryInterface;
        $this->toolsInterface                       = $toolRepositoryInterface;
        $this->jewelryQualityRepositoryInterface    = $jewelryQualityRepository;
        $this->pawnItemCategoryInterface            = $pawnItemCategoryInterface;
        $this->fasecoldaCodeServiceInterface        = $fasecoldaCodeUseCaseInterface;
        $this->fasecoldaPriceServiceInterface       = $fasecoldaPriceUseCaseRepositoryInterface;
        $this->fasecoldaPricerateInterface          = $fasecoldaPriceRateRepositoryInterface;
        $this->module                               = 'Artículos';
    }

    public function listPawnItems(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->pawnItemRepositoryInterface->searchPawnItem($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->pawnItemRepositoryInterface->countPawnItem($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->pawnItemRepositoryInterface->searchPawnItem($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->pawnItemRepositoryInterface->countPawnItem($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->pawnItemRepositoryInterface->countPawnItem(null);
            $list     = $this->pawnItemRepositoryInterface->listPawnItems($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'pawnItems'     => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Nombre', 'Fasecolda', 'Categoría', 'Calidad', 'Peso', 'Precio actual', 'Estado', 'Acciones'],
                'skip'          => $searchData['skip'],
                'paginate'      => $getPaginate['paginate'],
                'position'      => $getPaginate['position'],
                'page'          => $getPaginate['page'],
                'limit'         => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createPawnItem()
    {
        $fasecoldaClases = $this->fasecoldaCodeServiceInterface->getFasecoldaClases();
        $fasecoldaClases->values()->all();

        return [
            'jewelryQualities' => $this->jewelryQualityRepositoryInterface->getAllJewelryQualityNames(),
            'itemCategories'   => $this->pawnItemCategoryInterface->getAllPawnItemCategoryNames(),
            'clases'           => $fasecoldaClases->sortBy('Clase'),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storePawnItem(array $requestData)
    {
        $this->pawnItemRepositoryInterface->createPawnItem($requestData);
    }

    public function updatePawnItem(array $requestData, $id)
    {
        $update = new PawnItemRepository($this->getPawnItem($id));
        $update->updatePawnItem($requestData);
    }

    public function destroyPawnItem(int $id)
    {
        $update = new PawnItemRepository($this->getPawnItem($id));
        $update->deletePawnItem();
    }

    private function getPawnItem(int $id)
    {
        return $this->bankRepositoryInterface->findPawnItemById($id);
    }
}
