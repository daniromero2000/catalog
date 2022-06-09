<?php

namespace Modules\Ecommerce\Entities\Attributes\UseCases;

use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepository;
use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\UseCases\Interfaces\AttributeUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class AttributeUseCase implements AttributeUseCaseInterface
{
    private $module, $toolsInterface, $attributeRepositoryInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        AttributeRepositoryInterface $attributeRepositoryInterface
    ) {
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->attributeRepositoryInterface = $attributeRepositoryInterface;
        $this->module                       = 'Atributos';
    }

    public function listAttributes(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'attributes'   => $this->attributeRepositoryInterface->searchAttribute($searchData['q']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Nombre', 'Estado', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createAttribute()
    {
        return [
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storeAttribute(array $requestData)
    {
        $this->attributeRepositoryInterface->createAttribute($requestData);
    }

    public function showAttribute(array $requestData)
    {
    }

    public function updateAttribute(array $requestData, $id)
    {
        $update = new AttributeRepository($this->getAttribute($id));
        $update->updateAttribute($requestData);
    }

    public function destroyAttribute(int $id)
    {
        $update = new AttributeRepository($this->getAttribute($id));
        $update->deleteAttribute();
    }

    public function getAttribute($id)
    {
        return $this->attributeRepositoryInterface->findAttributeById($id);
    }
}
