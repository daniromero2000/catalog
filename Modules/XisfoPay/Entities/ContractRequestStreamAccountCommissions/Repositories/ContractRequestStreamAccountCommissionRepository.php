<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\ContractRequestStreamAccountCommission;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\ContractRequestStreamAccountCommissionNotFoundException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\CreateContractRequestStreamAccountCommissionErrorException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\DeletingContractRequestStreamAccountCommissionErrorException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\UpdateContractRequestStreamAccountCommissionErrorException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;

class ContractRequestStreamAccountCommissionRepository implements ContractRequestStreamAccountCommissionRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'amount',
        'is_default',
        'streaming_id',
        'created_at'
    ];

    public function __construct(ContractRequestStreamAccountCommission $contractRequestStreamAccountCommission)
    {
        $this->model = $contractRequestStreamAccountCommission;
    }

    public function createContractRequestStreamAccountCommission(array $data): ContractRequestStreamAccountCommission
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRequestStreamAccountCommissionErrorException($e->getMessage());
        }
    }

    public function updateContractRequestStreamAccountCommission(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateContractRequestStreamAccountCommissionErrorException($e->getMessage());
        }
    }

    public function findContractRequestStreamAccountCommissionById(int $id): ContractRequestStreamAccountCommission
    {
        try {
            return $this->model->with(['streaming'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractRequestStreamAccountCommissionNotFoundException($e->getMessage());
        }
    }

    public function deleteContractRequestStreamAccountCommission(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingContractRequestStreamAccountCommissionErrorException($e->getMessage());
        }
    }

    public function searchContractRequestStreamAccountCommissions(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractRequestStreamAccountCommissions();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchContractRequestStreamAccountCommissions($text)
                ->with(['streaming'])
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model
                ->with(['streaming'])
                ->whereBetween('created_at', [$from, $to])
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchContractRequestStreamAccountCommissions($text)
            ->with(['streaming'])
            ->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->paginate(10);
    }

    private function listContractRequestStreamAccountCommissions()
    {
        return  $this->model
            ->with(['streaming'])
            ->orderBy('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function findCommissionByStreaming(int $streamingId)
    {
        try {
            return $this->model
                ->with(['streaming'])
                ->where('streaming_id', $streamingId)
                ->where('is_default', 1)->firstOrFail($this->columns);
        } catch (ModelNotFoundException $th) {
            throw new ContractRequestStreamAccountCommissionNotFoundException($th);
        }
    }

    public function getAllStreamAccountCommissions(): Collection
    {
        return $this->model->get($this->columns);
    }
}
