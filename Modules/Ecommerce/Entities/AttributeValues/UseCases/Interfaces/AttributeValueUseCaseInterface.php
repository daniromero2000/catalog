<?php

namespace Modules\Ecommerce\Entities\AttributeValues\UseCases\Interfaces;

interface AttributeValueUseCaseInterface
{
    public function storeAttributeValue(array $requestData);

    public function updateAttributeValue(array $requestData, $id);

    public function destroyAttributeValue(int $id);
}
