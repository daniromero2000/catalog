<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeValueRepositoryInterface
{
    public function createAttributeValue(array $ArrayData): AttributeValue;

    public function associateToAttribute(Attribute $attribute): AttributeValue;

    public function dissociateFromAttribute(): bool;

    public function findProductAttributes(): Collection;

    public function updateAttributeValue(array $data): bool;

    public function find($id);

    public function findAttributeValueById(int $id): AttributeValue;

    public function countAttributeValues(int $attributeId);
}
