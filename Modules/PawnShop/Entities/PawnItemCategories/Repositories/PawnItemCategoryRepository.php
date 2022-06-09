<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\PawnShop\Entities\PawnItemCategories\PawnItemCategory;
use Modules\PawnShop\Entities\PawnItemCategories\Exceptions\PawnItemCategoryNotFoundException;
use Modules\PawnShop\Entities\PawnItemCategories\Exceptions\CreatePawnItemCategoryErrorException;
use Modules\PawnShop\Entities\PawnItemCategories\Exceptions\DeletingPawnItemCategoryErrorException;
use Modules\PawnShop\Entities\PawnItemCategories\Exceptions\UpdatePawnItemCategoryErrorException;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces\PawnItemCategoryRepositoryInterface;

class PawnItemCategoryRepository implements PawnItemCategoryRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'created_at'
    ];

    public function __construct(PawnItemCategory $jewelryQuality)
    {
        $this->model = $jewelryQuality;
    }

    public function createPawnItemCategory(array $data): PawnItemCategory
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePawnItemCategoryErrorException($e->getMessage());
        }
    }

    public function updatePawnItemCategory(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePawnItemCategoryErrorException($e->getMessage());
        }
    }

    public function findPawnItemCategoryById(int $id): PawnItemCategory
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PawnItemCategoryNotFoundException($e->getMessage());
        }
    }

    public function deletePawnItemCategory(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPawnItemCategoryErrorException($e->getMessage());
        }
    }

    public function searchPawnItemCategory(string $text = null)
    {
        if (is_null($text)) {
            return $this->listPawnItemCategories();
        } else {
            return $this->model->searchPawnItemCategory($text)
                ->select($this->columns)
                ->orderBy('name', 'desc')
                ->paginate(10);
        }
    }

    private function listPawnItemCategories()
    {
        return  $this->model
            ->select($this->columns)
            ->orderBy('name', 'asc')
            ->paginate(10);
    }

    public function getAllPawnItemCategoryNames()
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
