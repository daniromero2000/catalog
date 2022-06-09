<?php

namespace Modules\Customers\Entities\CustomerGroups\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerGroups\CustomerGroup;
use Modules\Customers\Entities\CustomerGroups\Exceptions\CustomerGroupNotFoundException;
use Modules\Customers\Entities\CustomerGroups\Exceptions\CreateCustomerGroupErrorException;
use Modules\Customers\Entities\CustomerGroups\Exceptions\DeletingCustomerGroupErrorException;
use Modules\Customers\Entities\CustomerGroups\Exceptions\UpdateCustomerGroupErrorException;
use Modules\Customers\Entities\CustomerGroups\Repositories\Interfaces\CustomerGroupRepositoryInterface;

class CustomerGroupRepository implements CustomerGroupRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'contract_status_id',
        'file',
        'is_signed',
        'is_active',
        'created_at'
    ];

    public function __construct(CustomerGroup $contract)
    {
        $this->model = $contract;
    }

    public function createCustomerGroup(array $data): CustomerGroup
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCustomerGroupErrorException($e->getMessage());
        }
    }

    public function updateCustomerGroup(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCustomerGroupErrorException($e->getMessage());
        }
    }

    public function findCustomerGroupById(int $id): CustomerGroup
    {
        try {
            return $this->model->with([
                'contractCommentaries',
                'contractStatusesLogs',
                'contractRequests',
                'contractRenewals'
            ])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CustomerGroupNotFoundException($e->getMessage());
        }
    }

    public function listCustomerGroups($totalView): Collection
    {
        return  $this->model->orderBy('id', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteCustomerGroup(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCustomerGroupErrorException($e->getMessage());
        }
    }

    public function searchCustomerGroup(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchCustomerGroup($text)->get($this->columns);
    }

    public function getAllCustomerGroupNames()
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name', 'code']);
    }
}
