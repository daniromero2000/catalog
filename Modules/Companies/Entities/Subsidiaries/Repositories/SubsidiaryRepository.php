<?php

namespace Modules\Companies\Entities\Subsidiaries\Repositories;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Subsidiaries\Exceptions\CreateSubsidiaryErrorException;
use Modules\Companies\Entities\Subsidiaries\Exceptions\DeletingSubsidiaryErrorException;
use Modules\Companies\Entities\Subsidiaries\Exceptions\SubsidiaryNotFoundException;
use Modules\Companies\Entities\Subsidiaries\Exceptions\UpdateSubsidiaryErrorException;

class SubsidiaryRepository implements SubsidiaryRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'address', 'phone', 'opening_hours', 'city_id'];

    public function __construct(Subsidiary $subsidiary)
    {
        $this->model = $subsidiary;
    }

    public function getAllSubsidiaryNames(): Collection
    {
        return $this->model->orderBy('name', 'desc')->get(['id', 'name']);
    }

    public function listSubsidiaries(int $totalView): Collection
    {
        return  $this->model->with('city')->orderBy('name', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function createSubsidiary(array $data): Subsidiary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateSubsidiaryErrorException($e->getMessage());
        }
    }

    public function updateSubsidiary(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateSubsidiaryErrorException($e->getMessage());
        }
    }

    public function findSubsidiaryById(int $subsidiaryId): Subsidiary
    {
        try {
            return $this->model->findOrFail($subsidiaryId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new SubsidiaryNotFoundException($e->getMessage());
        }
    }

    public function deleteSubsidiary(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingSubsidiaryErrorException($e->getMessage());
        }
    }

    public function searchSubsidiary(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
    }
}
