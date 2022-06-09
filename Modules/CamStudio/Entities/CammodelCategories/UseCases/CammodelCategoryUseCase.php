<?php

namespace Modules\CamStudio\Entities\CammodelCategories\UseCases;

use Modules\CamStudio\Entities\CammodelCategories\Repositories\CammodelCategoryRepository;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelCategories\UseCases\Interfaces\CammodelCategoryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelCategoryUseCase implements CammodelCategoryUseCaseInterface
{
    private $cammodelCategoryInterface, $toolsInterface, $module;

    public function __construct(
        ToolRepositoryInterface         $toolRepositoryInterface,
        CammodelCategoryRepositoryInterface $cammodelCategoryRepositoryInterface
    ) {
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->cammodelCategoryInterface = $cammodelCategoryRepositoryInterface;
        $this->module                    = 'Categorias de modelos';
    }

    public function listCammodelCategories(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'cammodelCategories' => $this->cammodelCategoryInterface->searchCammodelCategories($searchData['q']),
                'optionsRoutes'      => config('generals.optionRoutes'),
                'module'             => $this->module,
                'headers'            => ['Nombre', 'slug', 'Estado', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCammodelCategory(): array
    {
        return  [
            'categories'    => $this->cammodelCategoryInterface->listCammodelCategories(),
            'module'        => $this->module,
            'optionsRoutes' => $this->optionRoutes
        ];
    }

    public function storeCammodelCategory(array $requestData): void
    {
        $this->cammodelCategoryInterface->createCammodelCategory($requestData);
    }

    public function updateCammodelCategory($request, int $id): void
    {
        $cammodel_category = new CammodelCategoryRepository($this->getCammodelCategory($id));
        $cammodel_category->updateCammodelCategory($request->except('_token', '_method'));
    }

    public function destroyCammodelCategory(int $id): void
    {
        $cammodel = new CammodelCategoryRepository($this->getCammodelCategory($id));
        $cammodel->deleteCammodelCategory();
    }

    private function getCammodelCategory(int $id)
    {
        return $this->cammodelCategoryInterface->findCammodelCategoryById($id);
    }
}
