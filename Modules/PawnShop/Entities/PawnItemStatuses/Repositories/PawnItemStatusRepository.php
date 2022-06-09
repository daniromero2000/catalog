<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\PawnShop\Entities\PawnItemStatuses\PawnItemStatus;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\PawnItemStatusNotFoundException;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\CreatePawnItemStatusErrorException;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\DeletingPawnItemStatusErrorException;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\UpdatePawnItemStatusErrorException;
use Modules\PawnShop\Entities\PawnItemStatuses\Repositories\Interfaces\PawnItemStatusRepositoryInterface;

class PawnItemStatusRepository implements PawnItemStatusRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'color',
        'is_active',
        'created_at'
    ];

    public function __construct(PawnItemStatus $pawnItemStatus)
    {
        $this->model = $pawnItemStatus;
    }

    public function createPawnItemStatus(array $data): PawnItemStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePawnItemStatusErrorException($e->getMessage());
        }
    }

    public function updatePawnItemStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePawnItemStatusErrorException($e->getMessage());
        }
    }

    public function findPawnItemStatusById(int $id): PawnItemStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PawnItemStatusNotFoundException($e->getMessage());
        }
    }

    public function listPawnItemStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function searchPawnItemStatus(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPawnItemStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPawnItemStatus($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchPawnItemStatus($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('percentage', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countPawnItemStatus(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchPawnItemStatus($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchPawnItemStatus($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getAllPawnItemStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }

    public function deletePawnItemStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPawnItemStatusErrorException($e->getMessage());
        }
    }
}
