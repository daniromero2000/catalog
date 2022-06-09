<?php

namespace Modules\Companies\Entities\PermissionGroups\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface PermissionGroupRepositoryInterface
{
    public function getAllPermissionGroups(): Collection;
}
