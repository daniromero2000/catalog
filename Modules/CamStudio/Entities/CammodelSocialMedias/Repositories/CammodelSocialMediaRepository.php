<?php

namespace Modules\CamStudio\Entities\CammodelSocialMedias\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelSocialMedias\CammodelSocialMedia;
use Modules\CamStudio\Entities\CammodelSocialMedias\Exceptions\CammodelSocialMediaInvalidArgumentException;
use Modules\CamStudio\Entities\CammodelSocialMedias\Exceptions\CammodelSocialMediaNotFoundException;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;

class CammodelSocialMediaRepository implements CammodelSocialMediaRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'profile',
        'user',
        'password',
        'cammodel_id',
        'social_media_id',
        'corporate_phone_id',
        'updated_at',
        'created_at'
    ];

    public function __construct(CammodelSocialMedia $CammodelSocialMedia)
    {
        $this->model = $CammodelSocialMedia;
    }

    public function createCammodelSocialMedia(array $data): CammodelSocialMedia
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CammodelSocialMediaInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCammodelSocialMedia(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new CammodelSocialMediaInvalidArgumentException($e->getMessage());
        }
    }

    public function findCammodelSocialMediaById(int $CammodelSocialMediaId): CammodelSocialMedia
    {
        try {
            return $this->model->findOrFail($CammodelSocialMediaId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelSocialMediaNotFoundException($e->getMessage());
        }
    }

    public function listCammodelSocialMedias($totalView): Collection
    {
        return  $this->model->with(['socialMedia', 'cammodel'])
            ->orderBy('id', 'asc')->where('is_active', 1)
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function searchCammodelSocialMedias(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelSocialMedias($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelSocialMedias($text)
                ->where('is_active', 1)->skip($totalView)->take(10)
                ->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->where('is_active', 1)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCammodelSocialMedias($text)
            ->whereBetween('created_at', [$from, $to])
            ->where('is_active', 1)->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countCammodelSocialMedias(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->where('is_active', 1)->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCammodelSocialMedias($text)->where('is_active', 1)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->where('is_active', 1)->get(['id']));
        }

        return count($this->model->searchCammodelSocialMedias($text)->whereBetween('created_at', [$from, $to])
            ->where('is_active', 1)->get(['id']));
    }

    public function getCammodelsSocialMedia($socialPlatform = '3'): array
    {
        $idsCollection = $this->model
            ->where('social_media_id', $socialPlatform)->get(['id']);

        $ids_array = [];

        foreach ($idsCollection as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }

    public function getCammodelsSocialMediaForCommand($socialPlatform = ['2', '3'])
    {
        return $this->model->whereIn('social_media_id', $socialPlatform)
            ->orderBy('social_media_id', 'desc')
            ->get(['id', 'profile', 'social_media_id']);
    }

    public function getCammodelTwitterAccountId(int $cammodelId)
    {
        return $this->model->where('cammodel_id', $cammodelId)
            ->where('social_media_id', '3')->get('id');
    }
}
