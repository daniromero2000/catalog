<?php

namespace Modules\Companies\Entities\InterviewStatuses\Repositories;

use Modules\Companies\Entities\InterviewStatuses\Exceptions\InterviewStatusInvalidArgumentException;
use Modules\Companies\Entities\InterviewStatuses\Exceptions\InterviewStatusNotFoundException;
use Modules\Companies\Entities\InterviewStatuses\InterviewStatus;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\FuncCall;

class InterviewStatusRepository implements InterviewStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'color', 'is_active'];

    public function __construct(InterviewStatus $InterviewStatus)
    {
        $this->model = $InterviewStatus;
    }

    public function createInterviewStatus(array $data): InterviewStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new InterviewStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function updateInterviewStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new InterviewStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function findInterviewStatusById(int $id): InterviewStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new InterviewStatusNotFoundException($e->getMessage());
        }
    }

    public function listInterviewStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function getAllInterviewStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'desc')->get(['id', 'name']);
    }

    public function deleteInterviewStatus(): bool
    {
        return $this->model->delete();
    }

    public function findOrders(): Collection
    {
        return $this->model->orders()->get();
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function searchInterviewStatuses(?string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listInterviewStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchInterviewStatuses($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchInterviewStatuses($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('percentage', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countInterviewStatuses(?string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchInterviewStatus($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchInterviewStatus($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
