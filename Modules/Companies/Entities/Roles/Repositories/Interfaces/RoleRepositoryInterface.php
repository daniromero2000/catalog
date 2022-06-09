<?php

namespace Modules\Companies\Entities\Roles\Repositories\Interfaces;

use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function getAllRoleNames(): Collection;

    public function createRole(array $data): Role;

    public function listRoles(int $totalView): Collection;

    public function findRoleById(int $roleId): Role;

    public function updateRole(array $data): bool;

    public function deleteRole(): bool;

    public function attachToPermission(Permission $permission);

    public function attachToPermissions(...$permissions);

    public function syncPermissions(array $ids);

    public function listPermissions(): Collection;

    public function searchRole(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countRole(string $text = null,  $from = null, $to = null);

    public function listRole(int $totalView): Collection;
}
