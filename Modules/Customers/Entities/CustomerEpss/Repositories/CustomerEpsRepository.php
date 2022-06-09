<?php

namespace Modules\Customers\Entities\CustomerEpss\Repositories;

use Modules\Customers\Entities\CustomerEpss\CustomerEps;
use Modules\Customers\Entities\CustomerEpss\Repositories\Interfaces\CustomerEpsRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerEpsRepository implements CustomerEpsRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerEps $customerEps)
    {
        $this->model = $customerEps;
    }

    public function createCustomerEps(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
