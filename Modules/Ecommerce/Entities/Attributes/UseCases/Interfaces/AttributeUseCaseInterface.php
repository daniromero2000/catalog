<?php

namespace Modules\Ecommerce\Entities\Attributes\UseCases\Interfaces;

interface AttributeUseCaseInterface
{
    public function listAttributes(array $data): array;

    public function createAttribute();

    public function storeAttribute(array $requestData);

    public function updateAttribute(array $requestData, $id);

    public function destroyAttribute(int $id);

    public function getAttribute($id);
}
