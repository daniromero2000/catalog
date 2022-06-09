<?php

namespace Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeRepositoryInterface
{
    public function createAttribute(array $data): Attribute;

    public function findAttributeById(int $id): Attribute;

    public function updateAttribute(array $data): bool;

    public function listAttributeNames(): Collection;

    public function deleteAttribute(): ?bool;

    public function listCategoryAttributes($select): Collection;

    public function listAttributeValues(int $totalView): Collection;

    public function associateAttributeValue(AttributeValue $attributeValue): AttributeValue;

    public function searchAttribute(string $text = null);
}
