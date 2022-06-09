<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\ChaseTransferAmount;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\ChaseTransferAmountNotFoundException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\CreateChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\DeletingChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\UpdateChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\Interfaces\ChaseTransferAmountRepositoryInterface;

class ChaseTransferAmountRepository implements ChaseTransferAmountRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'amount',
        'chase_transfer_id',
        'streaming_id',
        'created_at'
    ];

    public function __construct(ChaseTransferAmount $chaseTransferAmount)
    {
        $this->model = $chaseTransferAmount;
    }

    public function createChaseTransferAmount(array $data): ChaseTransferAmount
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateChaseTransferAmountErrorException($e->getMessage());
        }
    }

    public function updateChaseTransferAmount(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateChaseTransferAmountErrorException($e->getMessage());
        }
    }

    public function findChaseTransferAmountById(int $id): ChaseTransferAmount
    {
        try {
            return $this->model->with(['chaseTransfer', 'streaming'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ChaseTransferAmountNotFoundException($e->getMessage());
        }
    }

    public function deleteChaseTransferAmount(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingChaseTransferAmountErrorException($e->getMessage());
        }
    }

    public function searchChaseTransferAmounts(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listChaseTransferAmounts();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchChaseTransferAmounts($text)
                ->with(['chaseTransfer', 'streaming'])
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model
                ->with(['chaseTransfer', 'streaming'])
                ->whereBetween('created_at', [$from, $to])
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchChaseTransferAmounts($text)
            ->with(['chaseTransfer', 'streaming'])
            ->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->paginate(10);
    }

    private function listChaseTransferAmounts()
    {
        return  $this->model
            ->with(['chaseTransfer', 'streaming'])
            ->select($this->columns)
            ->paginate(10);
    }

    public function findChaseTransferAmounts(int $chaseTransferId): Collection
    {
        return $this->model->where('chase_transfer_id', $chaseTransferId)
            ->get($this->columns);
    }
}
