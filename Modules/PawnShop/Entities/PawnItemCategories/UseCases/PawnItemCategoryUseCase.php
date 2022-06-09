<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemCategories\Exceptions\CreatePawnItemCategoryErrorException;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\PawnItemCategoryRepository;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces\PawnItemCategoryRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemCategories\UseCases\Interfaces\PawnItemCategoryUseCaseInterface;

class PawnItemCategoryUseCase implements PawnItemCategoryUseCaseInterface
{
    private $PawnItemCategoryInterface;

    public function __construct(
        PawnItemCategoryRepositoryInterface $PawnItemCategoryRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->PawnItemCategoryInterface = $PawnItemCategoryRepositoryInterface;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->module                    = 'Categorias Items Compraventa';
    }

    public function listPawnItemCategories(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'pawn_item_categories' => $this->PawnItemCategoryInterface->searchPawnItemCategory($searchData['q']),
                'optionsRoutes'        => config('generals.optionRoutes'),
                'module'               => $this->module,
                'headers'              => ['id', 'Nombre', 'Fecha', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createPawnItemCategory()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storePawnItemCategory(array $requestData)
    {
        $this->PawnItemCategoryInterface->createPawnItemCategory($requestData);
    }

    public function updatePawnItemCategory($request, int $id)
    {
        $update  = new PawnItemCategoryRepository($this->getPawnItemCategory($id));
        $update->updatePawnItemCategory($request->except('_token', '_method'));
    }

    public function destroyPawnItemCategory(int $id)
    {
        $update = new PawnItemCategoryRepository($this->getPawnItemCategory($id));
        $update->deletePawnItemCategory();
    }

    private function getPawnItemCategory(int $id)
    {
        return $this->PawnItemCategoryInterface->findPawnItemCategoryById($id);
    }
}
