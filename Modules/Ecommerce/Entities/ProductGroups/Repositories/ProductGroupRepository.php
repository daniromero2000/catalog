<?php

namespace Modules\Ecommerce\Entities\ProductGroups\Repositories;

use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;
use Modules\Ecommerce\Entities\ProductGroups\Exceptions\ProductGroupNotFoundErrorException;
use Modules\Ecommerce\Entities\ProductGroups\Exceptions\CreateProductGroupErrorException;
use Modules\Ecommerce\Entities\ProductGroups\Exceptions\UpdateProductGroupErrorException;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces\ProductGroupRepositoryInterface;

class ProductGroupRepository implements ProductGroupRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(ProductGroup $ProductGroup)
    {
        $this->model = $ProductGroup;
    }

    public function createProductGroup(array $data): ProductGroup
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateProductGroupErrorException($e->getMessage());
        }
    }

    public function findProductGroupById(int $id): ProductGroup
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // throw new ProductGroupNotFoundErrorException($e->getMessage());
        }
    }

    public function updateProductGroup(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            // throw new UpdateProductGroupErrorException($e->getMessage());
        }
    }

    public function deleteProductGroup(): bool
    {
        return $this->model->delete();
    }

    public function listproductGroups($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->all($columns, $orderBy, $sortBy);
    }

    public function saveProduct(Product $product)
    {
        $this->model->products()->save($product);
    }

    public function dissociateProducts()
    {
        $this->model->products()->each(function (Product $product) {
            $product->ProductGroup_id = null;
            $product->save();
        });
    }
}
