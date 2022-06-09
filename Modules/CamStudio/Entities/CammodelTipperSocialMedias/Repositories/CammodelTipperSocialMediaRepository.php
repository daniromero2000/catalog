<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\CammodelTipperSocialMedia;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions\CammodelTipperSocialMediaInvalidArgumentException;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions\CammodelTipperSocialMediaNotFoundException;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\Interfaces\CammodelTipperSocialMediaRepositoryInterface;

class CammodelTipperSocialMediaRepository implements CammodelTipperSocialMediaRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'profile',
        'cammodel_tipper_id',
        'social_media_id',
        'updated_at',
        'created_at'
    ];

    public function __construct(CammodelTipperSocialMedia $CammodelTipperSocialMedia)
    {
        $this->model = $CammodelTipperSocialMedia;
    }

    public function createCammodelTipperSocialMedia(array $data): CammodelTipperSocialMedia
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CammodelTipperSocialMediaInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCammodelTipperSocialMedia(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new CammodelTipperSocialMediaInvalidArgumentException($e->getMessage());
        }
    }

    public function findCammodelTipperSocialMediaById(int $CammodelTipperSocialMediaId): CammodelTipperSocialMedia
    {
        try {
            return $this->model->findOrFail($CammodelTipperSocialMediaId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelTipperSocialMediaNotFoundException($e->getMessage());
        }
    }

    public function searchCammodelTipperSocialMedias(string $text = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listCammodelTipperSocialMedias();
        }

        if (!is_null($text)) {
            return $this->model->searchCammodelTipperSocialMedias($text)
                ->with(['socialMedia', 'cammodelTipper'])
                ->select($this->columns)
                ->paginate(10);
        }
    }

    private function listCammodelTipperSocialMedias(): LengthAwarePaginator
    {
        return  $this->model->with(['socialMedia', 'cammodelTipper'])
            ->orderBy('id', 'asc')->select($this->columns)->paginate(10);
    }
}
