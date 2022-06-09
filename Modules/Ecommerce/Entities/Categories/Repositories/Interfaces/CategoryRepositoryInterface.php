<?php

namespace Modules\Ecommerce\Entities\Categories\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function listCategories(string $order = 'id', string $sort = 'desc', $except = []): Collection;

    public function listFrontCategories(string $order = 'name', string $sort = 'asc', $except = []): Collection;

    public function createCategory(array $data): Category;

    public function updateCategory(array $data): Category;

    public function findCategoryById(int $id): Category;

    public function rootCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection;

    public function deleteCategory(): bool;

    public function findProductsOrder();

    public function updateSortOrder(array $data);

    public function associateProduct(Product $product);

    public function findProducts(): Collection;

    public function findProductsSkip($totalviews, $take): Collection;

    public function countProducts();

    public function findProductsFilter($select, $totalviews, $take);

    public function syncProducts(array $data);

    public function detachProducts();

    public function deleteFile(array $file, $disk = null): bool;

    public function findCategoryBySlug(array $slug): Category;

    public function getCategoryProductAttributes($products);

    public function getCategoryProductAttributesFront();
}
