<?php

namespace Modules\Generals\Entities\VehicleTypes\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface VehicleTypeRepositoryInterface
{
    public function getAllVehicleTypesNames(): Collection;
}
