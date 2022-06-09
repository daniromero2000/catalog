<?php

namespace Modules\Companies\Entities\PermissionGroups\Repositories;

use Modules\Companies\Entities\PermissionGroups\PermissionGroup;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\PermissionGroups\Repositories\Interfaces\PermissionGroupRepositoryInterface;

class PermissionGroupRepository implements PermissionGroupRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'group_order'];

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->model = $permissionGroup;
    }

    public function getAllPermissionGroups(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }
}
