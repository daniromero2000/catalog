<?php

namespace Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces;

use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Collection;

interface ProductGroupRepositoryInterface
{
    public function createProductGroup(array $data): ProductGroup;

    public function findProductGroupById(int $id): ProductGroup;

    public function updateProductGroup(array $data): bool;

    public function deleteProductGroup(): bool;

    public function listproductGroups($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function saveProduct(Product $product);
}
