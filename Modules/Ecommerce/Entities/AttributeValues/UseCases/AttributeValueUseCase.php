<?php

namespace Modules\Ecommerce\Entities\AttributeValues\UseCases;

use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepository;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\UseCases\Interfaces\AttributeValueUseCaseInterface;

class AttributeValueUseCase implements AttributeValueUseCaseInterface
{
    private $attributeValueRepositoryInterface;

    public function __construct(
        AttributeValueRepositoryInterface $attributeValueRepositoryInterface
    ) {
        $this->attributeValueRepositoryInterface = $attributeValueRepositoryInterface;
    }

    public function storeAttributeValue(array $requestData)
    {
        $this->attributeValueRepositoryInterface->createAttributeValue($requestData);
    }

    public function updateAttributeValue(array $requestData, $id)
    {
        $update = new AttributeValueRepository($this->getAttributeValue($id));
        $update->updateAttributeValue($requestData);
    }

    public function destroyAttributeValue(int $id)
    {
        $update = new AttributeValueRepository($this->getAttributeValue($id));
        $update->deleteAttributeValue();
    }

    public function getAttributeValue($id)
    {
        return $this->attributeValueRepositoryInterface->findAttributeValueById($id);
    }
}
