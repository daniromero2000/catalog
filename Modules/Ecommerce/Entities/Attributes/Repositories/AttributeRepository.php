<?php

namespace Modules\Ecommerce\Entities\Attributes\Repositories;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\Attributes\Exceptions\AttributeNotFoundException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\CreateAttributeErrorException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\UpdateAttributeErrorException;
use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\DeletingAttributeErrorException;

class AttributeRepository implements AttributeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'is_active'];

    public function __construct(Attribute $attribute)
    {
        $this->model = $attribute;
    }

    public function createAttribute(array $data): Attribute
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateAttributeErrorException($e->getMessage());
        }
    }

    public function findAttributeById(int $id): Attribute
    {
        try {
            return $this->model->with(['values'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new AttributeNotFoundException($e->getMessage());
        }
    }

    public function updateAttribute(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateAttributeErrorException($e->getMessage());
        }
    }

    public function listAttributeNames(): Collection
    {
        return $this->model->where('is_active', 1)
            ->get($this->columns);
    }

    public function deleteAttribute(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingAttributeErrorException($e->getMessage());
        }
    }

    public function listCategoryAttributes($select): Collection
    {
        return $this->model->with(array('values' => function ($query) use ($select) {
            $query->whereIn('id', $select)->orderBy('value', 'asc');
        }))->get($this->columns);
    }

    public function listAttributeValues(int $totalView): Collection
    {
        return $this->model->values()->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function associateAttributeValue(AttributeValue $attributeValue): AttributeValue
    {
        return $this->model->values()->save($attributeValue);
    }

    public function searchAttribute(string $text = null)
    {
        if (is_null($text)) {
            return $this->listAttributes();
        } else {
            return $this->model->searchAttribute($text)
                ->select($this->columns)->orderBy('name', 'desc')->paginate(10);
        }
    }

    private function listAttributes()
    {
        return  $this->model->select($this->columns)->orderBy('name', 'asc')
            ->paginate(10);
    }
}
