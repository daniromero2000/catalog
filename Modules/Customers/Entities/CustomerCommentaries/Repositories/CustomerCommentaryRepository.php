<?php

namespace Modules\Customers\Entities\CustomerCommentaries\Repositories;

use Modules\Customers\Entities\CustomerCommentaries\CustomerCommentary;
use Modules\Customers\Entities\CustomerCommentaries\Repositories\Interfaces\CustomerCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerCommentaryRepository implements CustomerCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerCommentary $customerCommentary)
    {
        $this->model = $customerCommentary;
    }

    public function createCustomerCommentary(array $data): CustomerCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
