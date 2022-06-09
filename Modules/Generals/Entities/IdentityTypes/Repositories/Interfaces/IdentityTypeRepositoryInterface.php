<?php

namespace Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IdentityTypeRepositoryInterface
{
    public function getAllIdentityTypesNames(): Collection;
}
