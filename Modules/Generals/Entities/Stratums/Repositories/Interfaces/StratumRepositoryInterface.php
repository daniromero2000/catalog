<?php

namespace Modules\Generals\Entities\Stratums\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface StratumRepositoryInterface
{
    public function getAllStratumsNames(): Collection;
}
