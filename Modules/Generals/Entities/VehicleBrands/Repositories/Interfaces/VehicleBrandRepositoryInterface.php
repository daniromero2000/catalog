<?php

namespace Modules\Generals\Entities\VehicleBrands\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface VehicleBrandRepositoryInterface
{
    public function getAllVehicleBrandsNames(): Collection;
}
