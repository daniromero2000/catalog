<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransfers\ChaseTransfer;
use Modules\XisfoPay\Entities\ChaseTransfers\Exceptions\ChaseTransferNotFoundException;
use Modules\XisfoPay\Entities\ChaseTransfers\Exceptions\CreateChaseTransferErrorException;
use Modules\XisfoPay\Entities\ChaseTransfers\Exceptions\DeletingChaseTransferErrorException;
use Modules\XisfoPay\Entities\ChaseTransfers\Exceptions\UpdateChaseTransferErrorException;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces\ChaseTransferRepositoryInterface;

class ChaseTransferRepository implements ChaseTransferRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'chase_transfer_trm_id',
        'transfer_amount',
        'commission',
        'user_approves',
        'is_approved',
        'bank_movement_id',
        'created_at'
    ];

    public function __construct(ChaseTransfer $chaseTransfer)
    {
        $this->model = $chaseTransfer;
    }

    public function createChaseTransfer(array $data): ChaseTransfer
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateChaseTransferErrorException($e->getMessage());
        }
    }

    public function updateChaseTransfer(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateChaseTransferErrorException($e->getMessage());
        }
    }

    public function findChaseTransferById(int $id): ChaseTransfer
    {
        try {
            return $this->model->with(['chaseTransferTrm', 'chaseTransferAmounts', 'paymentRequests'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ChaseTransferNotFoundException($e->getMessage());
        }
    }

    public function deleteChaseTransfer(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingChaseTransferErrorException($e->getMessage());
        }
    }

    public function searchChaseTransfers(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listChaseTransfers();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchChaseTransfers($text)
                ->with(['chaseTransferTrm', 'paymentRequests'])
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model
                ->with(['chaseTransferTrm', 'paymentRequests'])
                ->whereBetween('created_at', [$from, $to])
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchChaseTransfers($text)
            ->with(['chaseTransferTrm', 'paymentRequests'])
            ->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->paginate(10);
    }

    private function listChaseTransfers()
    {
        return  $this->model
            ->with(['chaseTransferTrm', 'paymentRequests'])
            ->orderBy('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function getLastChaseTransfers(int $streamingId = null): Collection
    {
        return $this->model->take(10)
            ->with(['chaseTransferAmounts', 'paymentRequests'])
            ->where('is_approved', 1)
            ->where(function ($k) use ($streamingId) {
                if ($streamingId != null) {
                    $k->whereHas('chaseTransferAmounts', function ($q) use ($streamingId) {
                        $q->where('streaming_id', $streamingId);
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function findNotLegalizedChaseTransfers(): Collection
    {
        return $this->model->whereNull('bank_movement_id')
            ->where('is_approved', 1)
            ->get($this->columns);
    }
}
