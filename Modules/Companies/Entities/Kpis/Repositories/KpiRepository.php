<?php

namespace Modules\Companies\Entities\Kpis\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Kpis\Kpi;
use Modules\Companies\Entities\Kpis\Exceptions\KpiNotFoundException;
use Modules\Companies\Entities\Kpis\Exceptions\CreateKpiErrorException;
use Modules\Companies\Entities\Kpis\Exceptions\DeletingKpiErrorException;
use Modules\Companies\Entities\Kpis\Exceptions\UpdateKpiErrorException;
use Modules\Companies\Entities\Kpis\Repositories\Interfaces\KpiRepositoryInterface;

class KpiRepository implements KpiRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'subsidiary_id',
        'shift_id',
        'min_fortnight_goal',
        'created_at'
    ];

    public function __construct(Kpi $Kpi)
    {
        $this->model = $Kpi;
    }

    public function createKpi(array $data): Kpi
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateKpiErrorException($e->getMessage());
        }
    }

    public function updateKpi(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateKpiErrorException($e->getMessage());
        }
    }

    public function findKpiById(int $id): Kpi
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new KpiNotFoundException($e->getMessage());
        }
    }

    public function deleteKpi(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingKpiErrorException($e->getMessage());
        }
    }

    public function searchKpi(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listKpis();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchKpi($text)
                ->with(['subsidiary', 'shift'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['subsidiary', 'shift'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchKpi($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['subsidiary', 'shift'])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function listKpis()
    {
        return  $this->model->select($this->columns)
            ->with(['subsidiary', 'shift'])
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function getActiveKpis(): Collection
    {
        return $this->model->where('is_active', 1)->get($this->columns);
    }

    public function findKpiByShiftAndSubsidiary(int $subsidiaryId, int $shitfId)
    {
        return $this->model->where('subsidiary_id', $subsidiaryId)
            ->where('shift_id', $shitfId)
            ->where('is_active', 1)
            ->get($this->columns)->first();
    }
}
