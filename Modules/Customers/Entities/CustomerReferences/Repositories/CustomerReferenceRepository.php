<?php

namespace Modules\Customers\Entities\CustomerReferences\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Customers\Entities\CustomerReferences\Exceptions\CustomerReferenceInvalidArgumentException;
use Modules\Customers\Entities\CustomerReferences\Exceptions\CustomerReferenceNotFoundException;

class CustomerReferenceRepository implements CustomerReferenceRepositoryInterface

{
    protected $model;
    private $columns = [
        'id',
        'customer_id',
        'name',
        'last_name',
        'phone',
        'relationship_id',
        'created_at'
    ];

    public function __construct(
        CustomerReference $customerReference
    ) {
        $this->model = $customerReference;
    }

    public function createCustomerReference(array $data): CustomerReference
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CustomerReferenceInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCustomerReference(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            dd($e);
            throw new CustomerReferenceInvalidArgumentException($e->getMessage());
        }
    }

    public function findCustomerReferenceById(int $id): CustomerReference
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CustomerReferenceNotFoundException($e->getMessage());
        }
    }

    public function listCustomerReferences()
    {
        return $this->model->all($this->columns);
    }

    public function deleteCustomerReference(): bool
    {
        return $this->model->delete();
    }

    public function searchCustomerReference(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchCustomerReference($text)->get($this->columns);
    }
}
