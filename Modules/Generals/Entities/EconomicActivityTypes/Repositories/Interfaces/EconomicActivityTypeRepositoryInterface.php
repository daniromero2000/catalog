<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EconomicActivityTypeRepositoryInterface
{
    public function getAllEconomicActivityTypesNames(): Collection;
}
