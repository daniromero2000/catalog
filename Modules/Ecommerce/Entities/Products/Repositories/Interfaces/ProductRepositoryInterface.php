<?php

namespace Modules\Ecommerce\Entities\Products\Repositories\Interfaces;

use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function listProducts(int $totalView);

    public function listProductsForExport(): Collection;

    public function createProduct(array $data): Product;

    public function updateProduct(array $data): bool;

    public function findProductById(int $id): Product;

    public function deleteProduct(Product $product): bool;

    public function removeProduct(): bool;

    public function updateSortOrder(array $data);

    public function detachCategories();

    public function detachProductGroup();

    public function getCategories(): Collection;

    public function syncCategories(array $data);

    public function syncProducGroups(array $data);

    public function deleteFile(array $file, $disk = null): bool;

    public function deleteThumb(string $src): bool;

    public function findProductBySlug(array $slug): Product;

    public function searchProduct(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countProduct(string $text = null,  $from = null, $to = null);

    public function findProductImages(): Collection;

    public function saveCoverImage(UploadedFile $file): string;

    public function saveProductImages(Collection $collection);

    public function saveAttributeProductImages(Collection $collection, $productAttributeId);

    public function saveProductAttributes(ProductAttribute $productAttribute): ProductAttribute;

    public function listProductAttributes(): Collection;

    public function listProductGroups($group): Collection;

    public function removeProductAttribute(ProductAttribute $productAttribute): ?bool;

    public function saveCombination(ProductAttribute $productAttribute, AttributeValue ...$attributeValues): Collection;

    public function listCombinations(): Collection;

    public function findProductCombination(ProductAttribute $attribute);

    public function saveBrand(Brand $brand);

    public function findBrand();

    public function duplicateProduct(Int $id);
}
