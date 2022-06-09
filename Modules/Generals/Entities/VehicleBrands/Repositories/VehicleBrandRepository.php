<?php

namespace Modules\Generals\Entities\VehicleBrands\Repositories;

use Modules\Generals\Entities\VehicleBrands\VehicleBrand;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\VehicleBrands\Repositories\Interfaces\VehicleBrandRepositoryInterface;

class VehicleBrandRepository implements VehicleBrandRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'vehicle_brand'];

    public function __construct(VehicleBrand $vehicleBrand)
    {
        $this->model = $vehicleBrand;
    }

    public function getAllVehicleBrandsNames(): Collection
    {
        return $this->model->orderBy('vehicle_brand', 'asc')->get($this->columns);
    }
}
