<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRequestStatuses\ContractRequestStatus;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Exceptions\ContractRequestStatusNotFoundException;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Exceptions\CreateContractRequestStatusErrorException;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Exceptions\DeletingContractRequestStatusErrorException;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Exceptions\UpdateContractRequestStatusErrorException;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\Interfaces\ContractRequestStatusRepositoryInterface;

class ContractRequestStatusRepository implements ContractRequestStatusRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'color',
        'is_active',
        'created_at'
    ];

    public function __construct(ContractRequestStatus $contractRequestStatus)
    {
        $this->model = $contractRequestStatus;
    }

    public function createContractRequestStatus(array $data): ContractRequestStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRequestStatusErrorException($e->getMessage());
        }
    }

    public function updateContractRequestStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateContractRequestStatusErrorException($e->getMessage());
        }
    }

    public function findContractRequestStatusById(int $id): ContractRequestStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractRequestStatusNotFoundException($e->getMessage());
        }
    }

    public function listContractRequestStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteContractRequestStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingContractRequestStatusErrorException($e->getMessage());
        }
    }

    public function searchContractRequestStatus(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractRequestStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchContractRequestStatus($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchContractRequestStatus($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('percentage', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countContractRequestStatus(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchContractRequestStatus($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchContractRequestStatus($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getAllContractRequestStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }
}
