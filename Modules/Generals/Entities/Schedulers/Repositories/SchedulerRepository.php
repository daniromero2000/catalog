<?php

namespace Modules\Generals\Entities\Schedulers\Repositories;

use Modules\Generals\Entities\Schedulers\Scheduler;
use Modules\Generals\Entities\Schedulers\Repositories\Interfaces\SchedulerRepositoryInterface;
use Modules\Generals\Entities\Schedulers\Exceptions\CreateSchedulerErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Schedulers\Exceptions\DeletingSchedulerErrorException;
use Modules\Generals\Entities\Schedulers\Exceptions\SchedulerNotFoundException;

class SchedulerRepository implements SchedulerRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'employee_id', 'date', 'time', 'title', 'created_at'];

    public function __construct(Scheduler $schedulers)
    {
        $this->model = $schedulers;
    }

    public function createScheduler(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateSchedulerErrorException($e->getMessage());
        }
    }

    public function searchScheduler(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchScheduler($text)->get($this->columns);
    }

    public function listSchedulers(int $totalView): Collection
    {
        return  $this->model->orderBy('id', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function findSchedulerById(int $id): Scheduler
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new SchedulerNotFoundException($e->getMessage());
        }
    }

    public function updateScheduler(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteScheduler(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingSchedulerErrorException($e->getMessage());
        }
    }

    public function getAllSchedulerNames()
    {
        return '';
    }

    public function countScheduler(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchScheduler($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchScheduler($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function findSchedulerByIdEmployee($employee_id)
    {
        try {
            return $this->model->where('employee_id', $employee_id)
                ->get(['id', 'employee_id', 'date', 'time', 'title']);
        } catch (QueryException $e) {
            throw new SchedulerNotFoundException($e->getMessage());
        }
    }
}
