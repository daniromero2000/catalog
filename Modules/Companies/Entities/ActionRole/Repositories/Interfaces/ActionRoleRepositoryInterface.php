<?php

namespace Modules\Companies\Entities\ActionRole\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ActionRoleRepositoryInterface
{
    public function createActionRole(array $data);

    public function listActionRole(): Collection;
}
