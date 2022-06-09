<?php

namespace Modules\Customers\Entities\CustomerEconomicActivities\Repositories;

use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\Interfaces\CustomerEconomicActivityRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerEconomicActivityRepository implements CustomerEconomicActivityRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CustomerEconomicActivity $customerEconomicActivity
    ) {
        $this->model = $customerEconomicActivity;
    }

    public function createCustomerEconomicActivity(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
