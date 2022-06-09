<?php

namespace Modules\CamStudio\Entities\CammodelImages\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\CamStudio\Entities\CammodelImages\Exceptions\CammodelImageNotFoundErrorException;
use Modules\CamStudio\Entities\CammodelImages\Exceptions\DeletingCammodelImageErrorException;
use Modules\CamStudio\Entities\CammodelImages\Repositories\Interfaces\CammodelImageRepositoryInterface;

class CammodelImageRepository implements CammodelImageRepositoryInterface
{
    use SearchableTrait, UploadableTrait;
    protected $model, $CammodelImage;
    private $columns = ['id', 'cammodel_id', 'src'];

    public function __construct(CammodelImage $CammodelImage)
    {
        $this->model = $CammodelImage;
    }

    public function findCammodelImageBySlug(string $slug): CammodelImage
    {
        try {
            return $this->model->with(['images'])->where('slug', $slug)
                ->firstOrFail($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelImageNotFoundErrorException($e->getMessage());
        }
    }

    public function deleteThumb(string $src): bool
    {
        try {
            return $this->model->where('src', $src)->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelImageErrorException($e->getMessage());
        }
    }

    public function deleteCammodelImage(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelImageErrorException($e->getMessage());
        }
    }

    public function getAllCammodelImages(): Collection
    {
        return $this->model->orderBy('id', 'asc')->get($this->columns);
    }
}
