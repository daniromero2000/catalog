<?php

namespace Modules\Pqrs\Entities\PqrStatuses\Repositories;

use Modules\Pqrs\Entities\PqrStatuses\Exceptions\PqrStatusInvalidArgumentException;
use Modules\Pqrs\Entities\PqrStatuses\Exceptions\PqrStatusNotFoundException;
use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces\PqrStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class PqrStatusRepository implements PqrStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'color'];

    public function __construct(PqrStatus $pqrStatus)
    {
        $this->model = $pqrStatus;
    }

    public function createPqrStatus(array $data): PqrStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new PqrStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function updatePqrStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new PqrStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function findPqrStatusById(int $id): PqrStatus
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new PqrStatusNotFoundException($e->getMessage());
        }
    }

    public function listPqrStatuses(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }

    public function deletePqrStatus(): bool
    {
        return $this->model->delete();
    }

    public function findPqrs(): Collection
    {
        return $this->model->pqrs()->get();
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
