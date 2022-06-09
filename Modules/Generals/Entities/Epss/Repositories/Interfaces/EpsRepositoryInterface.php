<?php

namespace Modules\Generals\Entities\Epss\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EpsRepositoryInterface
{
    public function getAllEpsNames(): Collection;
}
