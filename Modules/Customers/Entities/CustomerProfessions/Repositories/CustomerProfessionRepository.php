<?php

namespace Modules\Customers\Entities\CustomerProfessions\Repositories;

use Modules\Customers\Entities\CustomerProfessions\CustomerProfession;
use Modules\Customers\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerProfessionRepository implements CustomerProfessionRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerProfession $customerProfession)
    {
        $this->model = $customerProfession;
    }

    public function createCustomerProfession(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
