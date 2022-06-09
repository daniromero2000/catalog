<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\CamStudio\Entities\Cammodels\Exceptions\CammodelNotFoundErrorException;
use Modules\CamStudio\Entities\Cammodels\Exceptions\CreateCammodelErrorException;
use Modules\CamStudio\Entities\Cammodels\Exceptions\DeletingCammodelErrorException;
use Modules\CamStudio\Entities\Cammodels\Exceptions\UpdateCammodelErrorException;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;

class CammodelRepository implements CammodelRepositoryInterface
{
    use SearchableTrait, UploadableTrait;
    protected $model, $cammodel;
    private $columns = [
        'id',
        'employee_id',
        'shift_id',
        'fake_age',
        'nickname',
        'height',
        'weight',
        'breast_cup_size',
        'tattoos_piercings',
        'meta',
        'slug',
        'likes_dislikes',
        'about_me',
        'private_show',
        'my_rules',
        'cover',
        'cover_page',
        'image_tks',
        'is_active',
        'created_at'
    ];

    public function __construct(Cammodel $cammodel)
    {
        $this->model = $cammodel;
    }

    public function createCamModel(array $data): Cammodel
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelErrorException($e->getMessage());
        }
    }

    public function saveCoverPageImage(UploadedFile $file, Cammodel $cammodel): string
    {
        return $file->store('cammodels/' . $cammodel, ['disk' => 'public']);
    }

    public function saveCammodelImages(Collection $collection, Cammodel $cammodel)
    {
        $collection->each(function (UploadedFile $file) use ($cammodel) {
            $filename = $this->storeFile($file, 'cammodels/' . $cammodel);
            $CammodelImage = new CammodelImage([
                'cammodel_id' => $this->model->id,
                'src'         => $filename
            ]);
            $this->model->images()->save($CammodelImage);
        });
    }

    public function findCammodelById(int $cammodelId): Cammodel
    {
        try {
            return $this->model->with([
                'employee', 'cammodelBannedCountries',
                'cammodelSocialMedia', 'cammodelStreamAccounts',
                'cammodelInactiveStreamAccounts', 'shift'
            ])->findOrFail($cammodelId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelNotFoundErrorException($e->getMessage());
        }
    }

    public function findCammodelBySlug(string $cammodelSlug): Cammodel
    {
        try {
            return $this->model->with(['images'])->where('slug', $cammodelSlug)
                ->firstOrFail($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelNotFoundErrorException($e->getMessage());
        }
    }

    public static function findCammodelBySlugStatic(string $cammodelSlug): Cammodel
    {
        try {
            return Cammodel::with(['cammodelBannedCountries'])
                ->where('slug', $cammodelSlug)->firstOrFail(['id',]);
        } catch (ModelNotFoundException $e) {
            throw new CammodelNotFoundErrorException($e->getMessage());
        }
    }

    public function updateCammodel(array $data): bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)
                ->update($filtered);
        } catch (QueryException $e) {
            throw new UpdateCammodelErrorException($e->getMessage());
        }
    }

    public function syncCategories(array $data): array
    {
        try {
            return $this->model->categories()->sync($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function syncTippers(array $data): array
    {
        try {
            return $this->model->tippers()->syncWithoutDetaching($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchCammodel(string $text = null, $active = 1): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listCammodels($active);
        } else {
            return $this->model->searchCammodel($text)->select($this->columns)
                ->with('employee')->where('is_active', $active)
                ->orderBy('nickname', 'desc')->paginate(10);
        }
    }

    private function listCammodels($active): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)->with('employee')
            ->where('is_active', $active)->orderBy('nickname', 'asc')
            ->paginate(10);
    }

    public function searchSubsidiaryCammodel(string $text = null, $subsidiary_id): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listSubsidiaryCammodels($subsidiary_id);
        } else {
            return $this->model->searchCammodel($text)->select($this->columns)
                ->with('employee')->where('is_active', 1)
                ->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                })->orderBy('nickname', 'desc')->paginate(10);
        }
    }

    public function listSubsidiaryCammodels($subsidiary_id): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)
            ->with('employee')
            ->whereHas('employee', function ($k) use ($subsidiary_id) {
                $k->where('subsidiary_id', $subsidiary_id);
            })->where('is_active', 1)->orderBy('nickname', 'asc')
            ->paginate(10);
    }

    public function detachCategories()
    {
        return $this->model->categories()->detach();
    }

    public function deleteCammodel(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelErrorException($e->getMessage());
        }
    }

    public function getAllCammodels(): Collection
    {
        return $this->model->orderBy('nickname', 'asc')->get($this->columns);
    }

    public function getAllCammodelNames(): Collection
    {
        return $this->model->orderBy('nickname', 'asc')->with('employee')
            ->where('shift_id', '!=', null)->where('is_active', 1)
            ->get(['id', 'nickname', 'employee_id']);
    }

    public function getSubsidiaryCammodelNames(int $subsidiary_id): Collection
    {
        return $this->model->whereHas('employee', function ($q) use ($subsidiary_id) {
            $q->where('subsidiary_id', $subsidiary_id);
        })->orderBy('nickname', 'asc')->with('employee')
            ->where('shift_id', '!=', null)->where('is_active', 1)
            ->get(['id', 'nickname', 'employee_id']);
    }

    public function getAllCammodelsWithStreamAccounts(): Collection
    {
        return $this->model->orderBy('nickname', 'asc')
            ->with('cammodelStreamAccountsWithoutSkype', 'employee')
            ->where('shift_id', '!=', null)->where('is_active', 1)
            ->get(['id', 'nickname', 'employee_id']);
    }

    public function getInactiveCammodelNames(): Collection
    {
        return $this->model->withTrashed()->with('employee')->where('is_active', 0)
            ->get(['id', 'nickname', 'employee_id', 'is_active']);
    }

    public function getSubsidiaryCammodels(int $subsidiary_id, int $inactivesTo = null): Collection
    {
        return $this->model->whereHas('employee', function ($q) use ($subsidiary_id) {
            $q->where('subsidiary_id', $subsidiary_id);
        })->orderBy('nickname', 'asc')
            ->with('employee', 'cammodelStreamAccountsWithoutSkype')
            ->where('shift_id', '!=', null)
            ->where(function ($k) use ($inactivesTo) {
                if ($inactivesTo == null) {
                    $k->where('is_active', 1);
                }
            })->get(['id', 'nickname', 'employee_id', 'is_active']);
    }
}
