<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Repositories;

use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelCategories\Exceptions\CammodelCategoryNotFoundException;
use Modules\CamStudio\Entities\CammodelCategories\Exceptions\DeletingCammodelCategoryErrorException;

class CammodelCategoryRepository implements CammodelCategoryRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = ['id', 'name', 'slug', 'description', 'cover', 'is_active'];

    public function __construct(CammodelCategory $category)
    {
        $this->model = $category;
    }

    public function findCammodelCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->orderBy($order, $sort)
            ->get($this->columns)->except($except);
    }

    public function createCammodelCategory(array $data): CammodelCategory
    {
        try {
            $collection = collect($data);
            if (isset($data['name'])) {
                $slug = str_slug($data['name']);
            }

            if (isset($data['cover']) && ($data['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($data['cover'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'cover'));
            $category = new CammodelCategory($merge->all());

            if (isset($data['parent'])) {
                $parent = $this->findCammodelCategoryById($data['parent']);
                $category->parent()->associate($parent);
            }

            $category->save();
            return $category;
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    public function updateCammodelCategory(array $data): CammodelCategory
    {
        $category = $this->findCammodelCategoryById($this->model->id);
        $collection = collect($data)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($data['cover']) && ($data['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($data['cover'], 'categories');
        }

        $merge = $collection->merge(compact('slug', 'cover'));

        // set parent attribute default value if not set
        $data['parent'] = $data['parent'] ?? 0;

        // If parent category is not set on update
        // just make current category as root
        // else we need to find the parent
        // and associate it as child
        if ((int) $data['parent'] == 0) {
            $category->saveAsRoot();
        } else {
            $parent = $this->findCammodelCategoryById($data['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());

        return $category;
    }

    public function findCammodelCategoryById(int $id): CammodelCategory
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelCategoryNotFoundException($e->getMessage());
        }
    }

    public function deleteCammodelCategory(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new  DeletingCammodelCategoryErrorException($e);
        }
    }

    public function countCammodels()
    {
        return $this->model->countCammodels;
    }

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])
                ->update($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->where('id',  $file['category'])
            ->update(['cover' => null]);
    }

    public function findCammodelCategoryBySlug(array $CammodelCategorySlug): CammodelCategory
    {
        try {
            return $this->model->where('slug', $CammodelCategorySlug)
                ->first($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelCategoryNotFoundException($e->getMessage());
        }
    }

    public function findParentCammodelCategory()
    {
        return $this->model->parent;
    }

    public function searchCammodelCategories(string $text = null)
    {
        if (is_null($text)) {
            return $this->listCammodelCategories();
        }

        return $this->model->searchCammodelCategories($text)
            ->select($this->columns)->paginate(10);
    }

    public function listCammodelCategories()
    {
        return  $this->model->select($this->columns)->paginate(10);
    }
}
