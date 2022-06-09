<?php

namespace Modules\Companies\Entities\Permissions\Repositories;

use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Permissions\Exceptions\CreatePermissionErrorException;
use Modules\Companies\Entities\Permissions\Exceptions\DeletingPermissionErrorException;
use Modules\Companies\Entities\Permissions\Exceptions\PermissionNotFoundException;
use Modules\Companies\Entities\Permissions\Exceptions\UpdatePermissionErrorException;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'display_name', 'icon', 'description'];

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getAllPermissionNames(): Collection
    {
        return $this->model->with(['permissionGroup'])->orderBy('name', 'asc')
            ->get(['id', 'name', 'display_name', 'permission_group_id']);
    }

    public function createPermission(array $data): Permission
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePermissionErrorException($e->getMessage());
        }
    }

    public function findPermissionById(int $permissionId): Permission
    {
        try {
            return $this->model->findOrFail($permissionId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PermissionNotFoundException($e->getMessage());
        }
    }

    public function updatePermission(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePermissionErrorException($e->getMessage());
        }
    }

    public function deletePermission(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPermissionErrorException($e->getMessage());
        }
    }

    public function listPermissions(int $totalView): Collection
    {
        return  $this->model->orderBy('display_name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function searchPermission(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPermission($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPermission($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchPermission($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('nickname', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countPermission(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchPermission($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchPermission($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function listPermission(int $totalView): Collection
    {
        return  $this->model->skip($totalView)->take(10)->get($this->columns);
    }
}
