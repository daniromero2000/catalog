<?php

namespace Modules\Ecommerce\Entities\Brands\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;
use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Collection;

interface BrandRepositoryInterface
{
    public function createBrand(array $data): Brand;

    public function findBrandById(int $id): Brand;

    public function updateBrand(array $data): bool;

    public function deleteBrand(): bool;

    public function list(int $totalView): Collection;

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function saveProduct(Product $product);

    public function searchBrands(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countBrands(string $text = null,  $from = null, $to = null);

    public function saveBrandLogo(UploadedFile $file, $client): string;
}
