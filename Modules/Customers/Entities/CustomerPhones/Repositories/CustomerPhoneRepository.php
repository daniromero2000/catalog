<?php

namespace Modules\Customers\Entities\CustomerPhones\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Customers\Entities\CustomerPhones\CustomerPhone;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Customers\Entities\Customers\Exceptions\UpdateCustomerErrorException;

class CustomerPhoneRepository implements CustomerPhoneRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerPhone $customerPhone)
    {
        $this->model = $customerPhone;
    }

    public function createCustomerPhone(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($customerPhone = $this->findCustomerPhone($request)) {
            return $customerPhone;
        } else {
            return;
        }
    }

    public function findCustomerPhoneById(int $id): CustomerPhone
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new AddressNotFoundException($e->getMessage());
        }
    }

    public function updateCustomerPhone($id)
    {
        try {
            return $this->model->where('id', $this->model->id)->update($id);
        } catch (QueryException $e) {
            throw new UpdateCustomerErrorException($e->getMessage());
        }
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['phone' => $data['phone']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
