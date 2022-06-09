<?php

namespace Modules\Customers\Entities\CustomerAddresses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Exceptions\CreateAddressErrorException;
use Modules\Customers\Entities\CustomerAddresses\Exceptions\AddressNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductUpdateErrorException;

class CustomerAddressRepository implements CustomerAddressRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerAddress $customerAddress)
    {
        $this->model = $customerAddress;
    }

    public function createCustomerAddress(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findAddressById(int $id): CustomerAddress
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new AddressNotFoundException($e->getMessage());
        }
    }
    public function deleteCustomerAddress($id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();
        return $data->delete();
    }

    public function updateCustomerAddress($id)
    {
        try {
            return $this->model->where('id', $this->model->id)->update($id);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e->getMessage());
        }
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['customer_id' => $data['customer_id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
