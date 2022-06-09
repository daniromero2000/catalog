<?php

namespace Modules\Ecommerce\Entities\Brands\Repositories;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Brands\Exceptions\BrandNotFoundErrorException;
use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Modules\Ecommerce\Entities\Brands\Exceptions\UpdateBrandErrorException;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Generals\Entities\Tools\UploadableTrait;

use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    use UploadableTrait;

    protected $model;
    private $columns = [
        'id',
        'name',
        'slug',
        'logo',
        'is_active'
    ];

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    public function createBrand(array $data): Brand
    {
        try {

            $collection = collect($data);
            if (isset($data['name'])) {
                $slug = str_slug($data['name']);
            }

            if (isset($data['logo']) && ($data['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($data['logo'], 'brands');
            }

            $merge = $collection->merge(compact('slug', 'logo'));
            $brand = new Brand($merge->all());
            $brand->save();

            return $brand;
        } catch (QueryException $e) {
            throw new CreateBrandErrorException($e->getMessage());
        }
    }

    public function findBrandById(int $id): Brand
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new BrandNotFoundErrorException($e->getMessage());
        }
    }

    public function updateBrand(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBrandErrorException($e->getMessage());
        }
    }

    public function deleteBrand(): bool
    {
        return $this->model->delete();
    }

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->all($this->columns, $orderBy, $sortBy);
    }

    public function listProducts(): Collection
    {
        return $this->model->products()->get();
    }

    public function saveProduct(Product $product)
    {
        $this->model->products()->save($product);
    }

    public function dissociateProducts()
    {
        $this->model->products()->each(function (Product $product) {
            $product->brand_id = null;
            $product->save();
        });
    }

    public function searchBrands(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->list($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchBrands($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchBrands($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countBrands(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchBrands($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchBrands($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function list(int $totalView): Collection
    {
        return $this->model->where('is_active', 1)->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function saveBrandLogo(UploadedFile $file, $brand): string
    {
        return $file->store('brands/' . $brand, ['disk' => 'public']);
    }
}
