<?php

namespace Modules\Companies\Entities\Roles\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Roles\Exceptions\CreateRoleErrorException;
use Modules\Companies\Entities\Roles\Exceptions\DeletingRoleErrorException;
use Modules\Companies\Entities\Roles\Exceptions\RoleNotFoundException;
use Modules\Companies\Entities\Roles\Exceptions\UpdateRoleErrorException;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'display_name', 'description'];

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getAllRoleNames(): Collection
    {
        return $this->model->where('status', 1)->orderBy('name', 'desc')
            ->get(['id', 'display_name']);
    }

    public function listRoles(int $totalView): Collection
    {
        return  $this->model->orderBy('name', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function createRole(array $data): Role
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateRoleErrorException($e->getMessage());
        }
    }

    public function findRoleById(int $roleId): Role
    {
        try {
            return $this->model->findOrFail($roleId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new RoleNotFoundException($e->getMessage());
        }
    }

    public function updateRole(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateRoleErrorException($e->getMessage());
        }
    }

    public function deleteRole(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingRoleErrorException($e->getMessage());
        }
    }

    public function attachToPermission(Permission $permission)
    {
        $this->model->attachPermission($permission);
    }

    public function attachToPermissions(...$permissions)
    {
        $this->model->attachPermissions($permissions);
    }

    public function syncPermissions(array $ids)
    {
        $this->model->syncPermissions($ids);
    }

    public function syncPermissionss(array $data)
    {
        $this->model->permissions()->sync($data);
    }

    public function detachPermissions()
    {
        $this->model->permissions()->detach();
    }

    public function syncActions(array $data)
    {
        $this->model->action()->sync($data);
    }

    public function detachActions()
    {
        try {
            $this->model->action()->detach();
        } catch (QueryException $th) {
            dd($th);
        }
    }

    public function listPermissions(): Collection
    {
        return $this->model->permissions()->get($this->columns);
    }

    public function listActions(): Collection
    {
        return $this->model->action()->get($this->columns);
    }

    public function searchRole(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listRole($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchRole($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchRole($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('nickname', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countRole(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchRole($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchRole($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function listRole(int $totalView): Collection
    {
        return  $this->model->skip($totalView)->take(10)->get($this->columns);
    }
}
