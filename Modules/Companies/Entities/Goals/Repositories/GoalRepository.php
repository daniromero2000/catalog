<?php

namespace Modules\Companies\Entities\Goals\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Goals\Goal;
use Modules\Companies\Entities\Goals\Exceptions\GoalNotFoundException;
use Modules\Companies\Entities\Goals\Exceptions\CreateGoalErrorException;
use Modules\Companies\Entities\Goals\Exceptions\DeletingGoalErrorException;
use Modules\Companies\Entities\Goals\Exceptions\UpdateGoalErrorException;
use Modules\Companies\Entities\Goals\Repositories\Interfaces\GoalRepositoryInterface;

class GoalRepository implements GoalRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'usd_goal',
        'bonus',
        'min_usd_goal',
        'description',
        'created_at'
    ];

    public function __construct(Goal $Goal)
    {
        $this->model = $Goal;
    }

    public function createGoal(array $data): Goal
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateGoalErrorException($e->getMessage());
        }
    }

    public function updateGoal(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateGoalErrorException($e->getMessage());
        }
    }

    public function findGoalById(int $id): Goal
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new GoalNotFoundException($e->getMessage());
        }
    }

    public function listGoals($totalView): Collection
    {
        return  $this->model
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteGoal(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingGoalErrorException($e->getMessage());
        }
    }

    public function searchGoal(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listGoals($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchGoal($text)
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

        return $this->model->searchGoal($text)
            ->whereBetween('created_at', [$from, $to])
            ->skip($totalView)
            ->take(10)
            ->get($this->columns);
    }

    public function countGoal(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchGoal($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchGoal($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getAllGoalNames()
    {
        return $this->model->get(['id', 'usd_goal']);
    }
}
