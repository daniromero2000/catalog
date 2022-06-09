<?php

namespace Modules\Generals\Entities\VehicleTypes\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\VehicleTypes\VehicleType;
use Modules\Generals\Entities\VehicleTypes\Repositories\Interfaces\VehicleTypeRepositoryInterface;

class VehicleTypeRepository implements VehicleTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'vehicle_type'];

    public function __construct(VehicleType $VehicleType)
    {
        $this->model = $VehicleType;
    }

    public function getAllVehicleTypesNames(): Collection
    {
        return $this->model->orderBy('vehicle_type', 'asc')->get($this->columns);
    }
}
