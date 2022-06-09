<?php

namespace Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CivilStatusRepositoryInterface
{
    public function getAllCivilStatusesNames(): Collection;
}
