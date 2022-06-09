<?php

namespace Modules\XisfoPay\Entities\ContractStatuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractStatuses\ContractStatus;
use Modules\XisfoPay\Entities\ContractStatuses\Exceptions\ContractStatusNotFoundException;
use Modules\XisfoPay\Entities\ContractStatuses\Exceptions\CreateContractStatusErrorException;
use Modules\XisfoPay\Entities\ContractStatuses\Exceptions\DeletingContractStatusErrorException;
use Modules\XisfoPay\Entities\ContractStatuses\Exceptions\UpdateContractStatusErrorException;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\Interfaces\ContractStatusRepositoryInterface;

class ContractStatusRepository implements ContractStatusRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'color',
        'is_active',
        'created_at'
    ];

    public function __construct(ContractStatus $contractStatus)
    {
        $this->model = $contractStatus;
    }

    public function createContractStatus(array $data): ContractStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractStatusErrorException($e->getMessage());
        }
    }

    public function updateContractStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateContractStatusErrorException($e->getMessage());
        }
    }

    public function findContractStatusById(int $id): ContractStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractStatusNotFoundException($e->getMessage());
        }
    }

    public function listContractStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function deleteContractStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingContractStatusErrorException($e->getMessage());
        }
    }

    public function searchContractStatus(string $text = null, int $totalView, $from = null, $to = null): Collection
    {

        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchContractStatus($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchContractStatus($text)
            ->whereBetween('created_at', [$from, $to])->orderBy('name', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countContractStatus(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchContractStatus($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchContractStatus($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getAllContractStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }
}
