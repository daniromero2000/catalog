<?php

namespace Modules\Ecommerce\Entities\Categories\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Categories\Exceptions\CategoryNotFoundException;
use Modules\Ecommerce\Entities\Categories\Exceptions\CategoryInvalidArgumentException;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    use UploadableTrait, ProductTransformable;
    protected $model;
    private $columns = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'banner',
        'is_visible_on_front'
    ];

    private $frontColumns = [
        'id',
        'name',
        'slug',
        'cover',
        'is_active',
        'banner',
        'is_visible_on_front'
    ];

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function listCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->orderBy($order, $sort)
            ->get($this->columns)->except($except);
    }

    public function listFrontCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->with(['homeProducts'])
            ->where('is_active', 1)->where('parent_id', null)
            ->orderBy($order, $sort)
            ->get($this->frontColumns)->except($except);
    }

    public function rootCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->whereIsRoot()
            ->orderBy($order, $sort)
            ->get($this->columns)
            ->except($except);
    }

    public function createCategory(array $data): Category
    {
        try {
            $collection = collect($data);
            if (isset($data['name'])) {
                $slug = str_slug($data['name']);
            }

            if (isset($data['cover']) && ($data['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($data['cover'], 'categories');
            }

            if (isset($data['banner']) && ($data['banner'] instanceof UploadedFile)) {
                $banner = $this->uploadOne($data['banner'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'cover', 'banner'));
            $category = new Category($merge->all());

            if (isset($data['parent'])) {
                $parent = $this->findCategoryById($data['parent']);
                $category->parent()->associate($parent);
            }

            $category->save();
            return $category;
        } catch (QueryException $e) {
            throw new CategoryInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCategory(array $data): Category
    {
        $category = $this->findCategoryById($this->model->id);
        $collection = collect($data)->except('_token');
        $slug = str_slug($collection->get('name'));
        $cover = $category->cover;
        $banner = $category->banner;
        if (isset($data['cover']) && ($data['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($data['cover'], 'categories');
        }

        if (isset($data['banner']) && ($data['banner'] instanceof UploadedFile)) {
            $banner = $this->uploadOne($data['banner'], 'categories');
        }

        $merge = $collection->merge(compact('slug', 'cover', 'banner'));

        // set parent attribute default value if not set
        $data['parent'] = $data['parent'] ?? 0;

        // If parent category is not set on update
        // just make current category as root
        // else we need to find the parent
        // and associate it as child
        if ((int) $data['parent'] == 0) {
            $category->saveAsRoot();
        } else {
            $parent = $this->findCategoryById($data['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());

        return $category;
    }

    public function findCategoryById(int $id): Category
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }

    public function deleteCategory(): bool
    {
        return $this->model->delete();
    }

    public function associateProduct(Product $product)
    {
        return $this->model->products()->save($product);
    }

    public function findProducts(): Collection
    {
        return $this->model->products;
    }

    public function countProducts()
    {
        return $this->model->countProducts;
    }

    public function findProductsSkip($totalviews, $take): Collection
    {
        return $this->model->products->skip($totalviews)->take($take);
    }

    public function findProductsOrder()
    {
        return $this->model->productsOrder;
    }

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])->update($data);
        } catch (QueryException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }

    public function findProductsFilter($select, $totalviews, $take)
    {
        return $this->model->productsFilter($select, $totalviews, $take);
    }

    public function syncProducts(array $data)
    {
        $this->model->products()->sync($data);
    }

    public function detachProducts()
    {
        $this->model->products()->detach();
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->update(['cover' => null], [$file['category']]);
    }

    public function findCategoryBySlug(array $slug): Category
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }

    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)
            ->firstOrFail($this->columns);
    }

    public function findParentCategory()
    {
        return $this->model->parent;
    }

    public function findChildren()
    {
        return $this->model->children;
    }

    public function getCategoryProductAttributes($products)
    {
        $productAttributes = new Collection();
        foreach ($products as $productAttribute) {
            foreach ($productAttribute->attributes as $attribute) {
                $productAttributes->push($attribute);
            }
        }

        $attributesValueses = new Collection();
        foreach ($productAttributes as $productAttribute) {
            if ($productAttribute->quantity) {
                foreach ($productAttribute->attributesValues as $attributesValues) {
                    $attributesValueses->push($attributesValues);
                }
            }
        }

        $values = new Collection;
        foreach ($attributesValueses as $valueses) {
            $values->push($valueses->id);
        }

        return $values->unique()->toArray();
    }

    public function getCategoryProductAttributesFront()
    {
        $products = $this->model->productsForFront;
        $productAttributes = new Collection();
        foreach ($products as $productAttribute) {
            foreach ($productAttribute->attributes as $attribute) {
                $productAttributes->push($attribute);
            }
        }

        $attributesValueses = new Collection();
        foreach ($productAttributes as $productAttribute) {
            if ($productAttribute->quantity) {
                foreach ($productAttribute->attributesValues as $attributesValues) {
                    $attributesValueses->push($attributesValues);
                }
            }
        }

        $values = new Collection;
        foreach ($attributesValueses as $valueses) {
            $values->push($valueses->id);
        }

        return $values->unique()->toArray();
    }
}
