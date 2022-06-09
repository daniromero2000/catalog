<?php

namespace Modules\Ecommerce\Entities\Products\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductCreateErrorException;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductUpdateErrorException;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\ProductImages\ProductImage;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductNotFoundException;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    use ProductTransformable, UploadableTrait;
    protected $model;
    private $columns = [
            'id',
            'sku',
            'name',
            'description',
            'cover',
            'quantity',
            'price',
            'is_active',
            'brand_id',
            'sale_price',
            'slug',
            'company_id',
            'tax_id'
        ],

        $listColumns = [
            'id',
            'sku',
            'name',
            'price',
            'is_active'
        ];

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function listProducts(int $totalView)
    {
        return  $this->model->orderBy('id', 'desc')->skip($totalView)->take(10)
            ->get($this->listColumns);
    }

    public function listProductsForExport(): Collection
    {
        return  $this->model->with('attributes')->orderBy('id', 'desc')
            ->get($this->columns);
    }

    public function createProduct(array $data): Product
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e->getMessage());
        }
    }

    public function updateProduct(array $data): bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)
                ->update($filtered);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e->getMessage());
        }
    }

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])
                ->update($data);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e->getMessage());
        }
    }

    public function findProductById(int $id): Product
    {
        try {
            return $this->transformProduct($this->model->with(['reviews'])
                ->findOrFail($id, $this->columns));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e->getMessage());
        }
    }

    public function findProductByIdFull(int $id): Product
    {
        try {
            return $this->model->with(['attributes', 'reviews'])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e->getMessage());
        }
    }

    public function deleteProduct(Product $product): bool
    {
        $product->images()->delete();
        return $product->delete();
    }

    public function removeProduct(): bool
    {
        return $this->model->where('id', $this->model->id)
            ->delete();
    }

    public function detachCategories()
    {
        $this->model->categories()->detach();
    }

    public function detachProductGroup()
    {
        $this->model->productGroups()->detach();
    }

    public function getCategories(): Collection
    {
        return $this->model->categories()->get();
    }

    public function syncCategories(array $data)
    {
        try {
            $this->model->categories()->sync($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function syncProducGroups(array $data)
    {
        try {
            $this->model->productGroups()->sync($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->update(['cover' => null], $file['product']);
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('product_images')
            ->where('src', $src)
            ->delete();
    }

    public function findProductBySlug(array $slug): Product
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e->getMessage());
        }
    }

    public function findOneByOrFail(array $data)
    {
        return $this->model->with(['reviews'])
            ->where($data)
            ->firstOrFail($this->columns);
    }

    public function searchProduct(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listProducts($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchProduct($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchProduct($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countProduct(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchProduct($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchProduct($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function findProductImages(): Collection
    {
        return $this->model->images()->get();
    }

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    public function saveProductImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file, 'products');
            $productImage = new ProductImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    public function saveAttributeProductImages(Collection $collection, $productAttributeId)
    {
        $collection->each(function (UploadedFile $file) use ($productAttributeId) {
            $filename = $this->storeFile($file, 'products');
            $productImage = new ProductImage([
                'product_attribute_id' => $productAttributeId,
                'src' => $filename
            ]);
            $productImage->save();
        });
    }

    public function saveProductAttributes(ProductAttribute $productAttribute): ProductAttribute
    {
        $this->model->attributes()->save($productAttribute);
        return $productAttribute;
    }

    public function listProductAttributes(): Collection
    {
        return $this->model->attributes()->get();
    }

    public function listProductGroups($group): Collection
    {
        return $this->model->whereHas('productGroups', function (Builder $query) use ($group) {
            $query->where('name', $group);
        })->where('is_active', 1)
            ->get($this->columns);
    }

    public function removeProductAttribute(ProductAttribute $productAttribute): ?bool
    {
        return $productAttribute->delete();
    }

    public function saveCombination(ProductAttribute $productAttribute, AttributeValue ...$attributeValues): Collection
    {
        return collect($attributeValues)->each(function (AttributeValue $value) use ($productAttribute) {
            return $productAttribute->attributesValues()->save($value);
        });
    }

    public function listCombinations(): Collection
    {
        return $this->model->attributes()
            ->map(function (ProductAttribute $productAttribute) {
                return $productAttribute->attributesValues;
            });
    }

    public function findProductCombination(ProductAttribute $productAttribute)
    {
        $values = $productAttribute->attributesValues()->get();

        return $values->map(function (AttributeValue $attributeValue) {
            return $attributeValue;
        })->keyBy(function (AttributeValue $item) {
            return strtolower($item->attribute->name);
        })->transform(function (AttributeValue $value) {
            return $value->value;
        });
    }

    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    public function findBrand()
    {
        return $this->model->brand;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }



    public function duplicateProduct(Int $id)
    {
        $product = $this->findProductByIdFull($id);
        $productAttributes = $product->attributes;
        $newProduct = $product->replicate();
        $newProduct->sku = rand(0, 10000000);
        $newProduct->setRelations([]);
        $newProduct->push();

        //re-sync everything
        foreach ($productAttributes as $attributes => $attribute) {
            $newAttribute = $attribute->replicate();
            $newProduct->attributes()->save($newAttribute);
            foreach ($attribute->attributesValues as $attributeValues => $attributeValue) {
                foreach ($newProduct->attributes as $key => $value) {
                    $relation = $attributeValue;
                }
                $newAttribute->attributesValues()->save($relation);
            }
        }
        return $newProduct;
    }
}
