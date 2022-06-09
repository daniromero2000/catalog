<?php

namespace Modules\Companies\Entities\Actions\Repositories;

use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Actions\Exceptions\UpdateActionErrorException;
use Modules\Companies\Entities\Actions\Exceptions\ActionNotFoundException;
use Modules\Companies\Entities\Actions\Exceptions\CreateActionErrorException;

class ActionRepository implements ActionRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'permission_id', 'name', 'icon', 'route', 'principal'];

    public function __construct(Action $action)
    {
        $this->model = $action;
    }

    public function createAction(array $data): Action
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateActionErrorException($e->getMessage());
        }
    }

    public function getAttachedActionNames($attachedPermissionsArrayIds): Collection
    {
        return $this->model->with('permission')->whereIn('permission_id', $attachedPermissionsArrayIds)
            ->where('status', 1)->orderBy('name', 'desc')
            ->get(['id', 'name', 'permission_id']);
    }

    public function findActionById(int $id): Action
    {
        try {
            return $this->model->with('role:id,name')->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ActionNotFoundException($e->getMessage());
        }
    }

    public function updateAction(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateActionErrorException($e->getMessage());
        }
    }

    public function deleteAction(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listActions(int $totalView): Collection
    {
        return $this->model->with('permission')->orderBy('permission_id', 'asc')
            ->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function searchAction(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listActions($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchAction($text)
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

        return $this->model->searchAction($text)->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countAction(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchAction($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchAction($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
