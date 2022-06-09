<?php

namespace Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Module\CamStudio\Entities\CammodelStreamAccounts\Exceptions\DeletingCammodelStreamAccountErrorException;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Exceptions\CammodelStreamAccountInvalidArgumentException;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Exceptions\CammodelStreamAccountNotFoundException;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;

class CammodelStreamAccountRepository implements CammodelStreamAccountRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'profile',
        'user',
        'password',
        'cammodel_id',
        'account_api_token',
        'streaming_id',
        'corporate_phone_id',
        'updated_at',
        'created_at'
    ];

    public function __construct(CammodelStreamAccount $CammodelStreamAccount)
    {
        $this->model = $CammodelStreamAccount;
    }

    public function createCammodelStreamAccount(array $data): CammodelStreamAccount
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CammodelStreamAccountInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCammodelStreamAccount(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new CammodelStreamAccountInvalidArgumentException($e->getMessage());
        }
    }

    public function findCammodelStreamAccountById(int $CammodelStreamAccountId): CammodelStreamAccount
    {
        try {
            return $this->model->with('streamingWithRate')
                ->findOrFail($CammodelStreamAccountId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelStreamAccountNotFoundException($e->getMessage());
        }
    }

    public function listCammodelStreamAccounts($totalView): Collection
    {
        return  $this->model->with(['streaming', 'cammodel'])
            ->where('is_active', 1)->orderBy('id', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteCammodelStreamAccount(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelStreamAccountErrorException($e->getMessage());
        }
    }

    public function searchCammodelStreamAccounts(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelStreamAccounts($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelStreamAccounts($text)
                ->with(['streaming', 'cammodel'])->where('is_active', 1)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['streaming', 'cammodel'])->where('is_active', 1)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCammodelStreamAccounts($text)
            ->with(['streaming', 'cammodel'])->where('is_active', 1)
            ->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchCammodelStreamAccounts($text)->get($this->columns);
    }

    public function countCammodelStreamAccounts(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->where('is_active', 1)->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelStreamAccounts($text)->where('is_active', 1)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->where('is_active', 1)->whereBetween('created_at', [$from, $to])->count();
        }

        return $this->model->searchCammodelStreamAccounts($text)
            ->whereBetween('created_at', [$from, $to])->where('is_active', 1)->count();
    }

    public function getCammodelsStreamAccounts($streamingId = null)
    {
        if ($streamingId == '1') {
            return $this->model->where('streaming_id', 1)
                ->where('account_api_token', '!=', null)
                ->where('is_active', 1)
                ->get(['id', 'account_api_token', 'streaming_id', 'profile']);
        } else {
            return $this->model->where('streaming_id', '!=', 1)
                ->where('is_active', 1)
                ->get(['id', 'streaming_id', 'profile']);
        }
    }

    public function getCammodelChaturbateAccountId(int $CammodelId)
    {
        return $this->model->where('cammodel_id', $CammodelId)
            ->where('streaming_id', '1')->get('id');
    }

    public function findStreamingAccountByProfile(string $profile, int $streamingId = 1)
    {
        return $this->model->where('profile', 'like', "%" . $profile . "%")
            ->where('streaming_id', $streamingId)->get('id')->first();
    }

    public function getAccountsByStreaming(int $streamingId)
    {
        return $this->model->where('streaming_id', $streamingId)
            ->get(['id', 'user']);
    }

    public function findStreamAccountByCammodel(int $cammodelId)
    {
        return $this->model->where('cammodel_id', $cammodelId)
            ->get('id');
    }
}
