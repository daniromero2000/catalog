<?php

namespace Modules\Customers\Entities\CustomerVehicles\Repositories;

use Modules\Customers\Entities\CustomerVehicles\CustomerVehicle;
use Modules\Customers\Entities\CustomerVehicles\Repositories\Interfaces\CustomerVehicleRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerVehicleRepository implements CustomerVehicleRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerVehicle $customerVehicle)
    {
        $this->model = $customerVehicle;
    }

    public function createCustomerVehicle(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
