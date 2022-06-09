<?php

namespace Modules\CamStudio\Entities\CammodelFines\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelFines\CammodelFine;
use Modules\CamStudio\Entities\CammodelFines\Exceptions\CammodelFineNotFoundException;
use Modules\CamStudio\Entities\CammodelFines\Exceptions\CreateCammodelFineErrorException;
use Modules\CamStudio\Entities\CammodelFines\Exceptions\DeletingCammodelFineErrorException;
use Modules\CamStudio\Entities\CammodelFines\Exceptions\UpdateCammodelFineErrorException;
use Modules\CamStudio\Entities\CammodelFines\Repositories\Interfaces\CammodelFineRepositoryInterface;

class CammodelFineRepository implements CammodelFineRepositoryInterface
{
    protected $model;
    private $columns = [
        'id', 'cammodel_id', 'foul_id', 'cammodel_payroll_id',
        'is_aprobed', 'created_at'
    ];

    public function __construct(CammodelFine $cammodelFine)
    {
        $this->model = $cammodelFine;
    }

    public function createCammodelFine(array $data): CammodelFine
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelFineErrorException($e->getMessage());
        }
    }

    public function updateCammodelFine(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCammodelFineErrorException($e->getMessage());
        }
    }

    public function findCammodelFineById(int $cammodelFineId): CammodelFine
    {
        try {
            return $this->model->findOrFail($cammodelFineId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelFineNotFoundException($e->getMessage());
        }
    }

    public function deleteCammodelFine(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelFineErrorException($e->getMessage());
        }
    }

    public function searchCammodelFine(string $text = null, $from = null, $to = null): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelFines();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelFine($text)
                ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchCammodelFine($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
            ->select($this->columns)->paginate(10);
    }

    public function listCammodelFines(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)
            ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function searchSubsidiaryCammodelFine(string $text = null, int $subsidiary_id, $from = null, $to = null): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listSubsidiaryCammodelFines($subsidiary_id);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelFine($text)
                ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    });
                })->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    });
                })->select($this->columns)->paginate(10);
        }
        return $this->model->searchCammodelFine($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['cammodel', 'foul'])->orderby('created_at', 'desc')
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                });
            })->select($this->columns)->paginate(10);
    }

    public function listSubsidiaryCammodelFines(int $subsidiary_id): LengthAwarePaginator
    {
        return  $this->model->with(['cammodel', 'foul'])
            ->orderby('created_at', 'desc')
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                });
            })->paginate(10);
    }

    public function getNotAvailableFouls($today): Collection
    {
        return $this->model->where('created_at', 'LIKE', $today . '%')
            ->get(['foul_id', 'cammodel_id']);
    }

    public function findUnchargedCammodelFinesByCammodel(int $cammodelId, array $dates): Collection
    {
        return $this->model->with(['foul'])->whereBetween('created_at', $dates)
            ->where('cammodel_id', $cammodelId)->where('cammodel_payroll_id', null)
            ->where('is_aprobed', 1)->get($this->columns);
    }

    public function findSubsidiaryUnchargedCammodelFinesByCammodel(array $dates, int $subsidiary_id): Collection
    {
        return $this->model->with(['foul'])
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                });
            })->whereBetween('created_at', $dates)->where('cammodel_payroll_id', null)
            ->where('is_aprobed', 1)->get($this->columns);
    }
}
