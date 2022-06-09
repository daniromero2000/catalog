<?php

namespace Modules\PawnShop\Entities\PawnItems\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\PawnShop\Entities\PawnItems\Exceptions\CreatePawnItemErrorException;
use Modules\PawnShop\Entities\PawnItems\Exceptions\DeletePawnItemErrorException;
use Modules\PawnShop\Entities\PawnItems\Exceptions\PawnItemNotFoundException;
use Modules\PawnShop\Entities\PawnItems\Exceptions\UpdatePawnItemErrorException;
use Modules\PawnShop\Entities\PawnItems\PawnItem;
use Modules\PawnShop\Entities\PawnItems\Repositories\Interfaces\PawnItemRepositoryInterface;

class PawnItemRepository implements PawnItemRepositoryInterface
{
    protected $model;
    private $columns = [
        'name',
        'description',
        'price',
        'approbed_price',
        'status',
        'customer_id',
        'pawn_item_status_id'
    ];

    public function __construct(PawnItem $pawnItem)
    {
        $this->model = $pawnItem;
    }

    public function createPawnItem(array $data): PawnItem
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePawnItemErrorException($e->getMessage());
        }
    }

    public function updatePawnItem(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePawnItemErrorException($e->getMessage());
        }
    }

    public function findPawnItemById(int $id): PawnItem
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PawnItemNotFoundException($e->getMessage());
        }
    }

    public function listPawnItems(int $totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deletePawnItem(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletePawnItemErrorException($e->getMessage());
        }
    }

    public function searchPawnItem(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPawnItems($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPawnItem($text)
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        return $this->model->searchPawnItem($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('name', 'desc')
            ->skip($totalView)
            ->take(10)
            ->get($this->columns);
    }


    public function countPawnItem(string $text = null,  $from = null, $to = null): int
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchPawnItem($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchPawnItem($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
