<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\CreateChaseTransferTrmErrorException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\DeletingChaseTransferTrmErrorException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\ChaseTransferTrmNotFoundException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\UpdateChaseTransferTrmErrorException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\ChaseTransferTrm;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;

class ChaseTransferTrmRepository implements ChaseTransferTrmRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'trm',
        'bank_id',
        'user',
        'is_active',
        'updated_at'
    ];

    public function __construct(ChaseTransferTrm $chaseTransferTrm)
    {
        $this->model = $chaseTransferTrm;
    }

    public function createChaseTransferTrm(array $data): ChaseTransferTrm
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateChaseTransferTrmErrorException($e->getMessage());
        }
    }

    public function updateChaseTransferTrm(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateChaseTransferTrmErrorException($e->getMessage());
        }
    }

    public function findChaseTransferTrmById(int $id): ChaseTransferTrm
    {
        try {
            return $this->model->with('bank')->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ChaseTransferTrmNotFoundException($e->getMessage());
        }
    }

    public function deleteChaseTransferTrm(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingChaseTransferTrmErrorException($e->getMessage());
        }
    }

    public function searchChaseTransferTrms(string $text = null, $from = null, $to = null, $active = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listChaseTransferTrms($active);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchChaseTransferTrms($text)
                ->select($this->columns)
                ->where(function ($q) use ($active) {
                    if ($active !== null) {
                        $q->where('is_active', $active);
                    }
                })
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->select($this->columns)
                ->where(function ($q) use ($active) {
                    if ($active !== null) {
                        $q->where('is_active', $active);
                    }
                })
                ->paginate(10);
        }

        return $this->model->searchChaseTransferTrms($text)
            ->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->where(function ($q) use ($active) {
                if ($active !== null) {
                    $q->where('is_active', $active);
                }
            })
            ->paginate(10);
    }

    private function listChaseTransferTrms($active = null)
    {
        return  $this->model->orderBy('id', 'desc')
            ->select($this->columns)
            ->where(function ($q) use ($active) {
                if ($active !== null) {
                    $q->where('is_active', $active);
                }
            })
            ->paginate(10);
    }

    public function getActiveChaseTransferTrm(): Collection
    {
        return $this->model->with(['bank'])
            ->where('is_active', 1)->get($this->columns);
    }

    public function deactivateTRMs($bank)
    {
        return $this->model->where('is_active', 1)
            ->where('bank_id', $bank)
            ->orderBy('id', 'desc')
            ->first()
            ->update(['is_active' => 0]);
    }
}
