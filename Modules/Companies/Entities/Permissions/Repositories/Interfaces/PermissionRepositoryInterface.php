<?php

namespace Modules\Companies\Entities\Permissions\Repositories\Interfaces;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function getAllPermissionNames(): Collection;

    public function createPermission(array $data);

    public function findPermissionById(int $permissionId): Permission;

    public function updatePermission(array $data): bool;

    public function deletePermission(): bool;

    public function listPermissions(int $totalView): Collection;

    public function searchPermission(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countPermission(string $text = null,  $from = null, $to = null);

    public function listPermission(int $totalView): Collection;
}
