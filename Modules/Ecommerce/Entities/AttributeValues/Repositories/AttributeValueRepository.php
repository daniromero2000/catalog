<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Repositories;

use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\AttributeValues\Exceptions\AttributeValueNotFoundException;
use Modules\Ecommerce\Entities\AttributeValues\Exceptions\CreateAttributeValueErrorException;
use Modules\Ecommerce\Entities\AttributeValues\Exceptions\DeletingAttributeValueErrorException;
use Modules\Ecommerce\Entities\AttributeValues\Exceptions\UpdateAttributeValueErrorException;

class AttributeValueRepository implements AttributeValueRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'value'
    ];

    public function __construct(AttributeValue $attributeValue)
    {
        $this->model = $attributeValue;
    }

    public function createAttributeValue(array $requestData): AttributeValue
    {
        try {
            return $this->model->create($requestData);
        } catch (QueryException $e) {
            throw new CreateAttributeValueErrorException($e->getMessage());
        }
    }

    public function associateToAttribute(Attribute $attribute): AttributeValue
    {
        $this->model->attribute()->associate($attribute);
        $this->model->save();
        return $this->model;
    }

    public function dissociateFromAttribute(): bool
    {
        return $this->model->delete();
    }

    public function deleteAttributeValue(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingAttributeValueErrorException($e->getMessage());
        }
    }

    public function findProductAttributes(): Collection
    {
        return $this->model->productAttributes()->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findAttributeValueById(int $id): AttributeValue
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new AttributeValueNotFoundException($e->getMessage());
        }
    }

    public function updateAttributeValue(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateAttributeValueErrorException($e->getMessage());
        }
    }

    public function countAttributeValues(int $attributeId)
    {
        return count($this->model->where('attribute_id', $attributeId)
            ->get($this->columns));
    }
}
