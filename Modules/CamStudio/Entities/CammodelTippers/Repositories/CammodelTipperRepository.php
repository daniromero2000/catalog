<?php

namespace Modules\CamStudio\Entities\CammodelTippers\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelTippers\CammodelTipper;
use Modules\CamStudio\Entities\CammodelTippers\Exceptions\CammodelTipperNotFoundException;
use Modules\CamStudio\Entities\CammodelTippers\Exceptions\CreateCammodelTipperErrorException;
use Modules\CamStudio\Entities\CammodelTippers\Exceptions\DeletingCammodelTipperErrorException;
use Modules\CamStudio\Entities\CammodelTippers\Exceptions\UpdateCammodelTipperErrorException;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\Interfaces\CammodelTipperRepositoryInterface;

class CammodelTipperRepository implements CammodelTipperRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'profile',
        'nickname',
        'streaming_id',
        'birthday',
        'location',
        'pleasures',
        'rate',
        'observations',
        'created_at'
    ];

    public function __construct(CammodelTipper $cammodelTipper)
    {
        $this->model = $cammodelTipper;
    }

    public function createCammodelTipper(array $data): CammodelTipper
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelTipperErrorException($e->getMessage());
        }
    }

    public function updateCammodelTipper(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCammodelTipperErrorException($e->getMessage());
        }
    }

    public function findCammodelTipperById(int $CammodelTipperid): CammodelTipper
    {
        try {
            return $this->model
                ->with(['streaming', 'cammodels', 'cammodelTipperSocialMedia'])
                ->findOrFail($CammodelTipperid, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelTipperNotFoundException($e->getMessage());
        }
    }

    public function findCammodelTipperByParams(array $requestData)
    {
        return $this->model->where('profile', $requestData['profile'])
            ->where('streaming_id', $requestData['streaming_id'])
            ->get('id')->first();
    }

    public function deleteCammodelTipper(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelTipperErrorException($e->getMessage());
        }
    }

    public function searchCammodelTipper(string $text = null, $from = null, $to = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listCammodelTippers();
        }

        if (!is_null($text)) {
            return $this->model->searchCammodelTipper($text)
                ->with(['streaming'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }
    }

    private function listCammodelTippers(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)
            ->with(['streaming'])
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function getCammodelTipperProfiles()
    {
        return $this->model->orderBy('profile')->get(['id', 'profile']);
    }
}
