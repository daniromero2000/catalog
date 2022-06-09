<?php

namespace Modules\Customers\Entities\CustomerIdentities\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Modules\Customers\Entities\CustomerIdentities\Exceptions\CustomerIdentityNotFoundException;
use Modules\Customers\Entities\CustomerIdentities\Exceptions\UpdateCustomerIdentityErrorException;

class CustomerIdentityRepository implements CustomerIdentityRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'identity_type_id',
        'identity_number',
        'expedition_date',
        'city_id',
        'customer_id',
        'file',
        'is_active',
        'is_aprobed',
        'created_at'
    ];

    public function __construct(
        CustomerIdentity $customerIdentity

    ) {
        $this->model = $customerIdentity;
    }

    public function createCustomerIdentity(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($customerIdentity = $this->findCustomerIdentityById($request)) {
            return $customerIdentity;
        } else {
            return;
        }
    }

    public function updateCustomerIdentity(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCustomerIdentityErrorException($e->getMessage());
        }
    }

    public function findCustomerIdentityById(int $id): CustomerIdentity
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CustomerIdentityNotFoundException($e->getMessage());
        }
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['identity_number' => $data['identity_number']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function saveIdFile(UploadedFile $file, $number): string
    {
        return $file->store('customer-identities/' . $number, ['disk' => 'public']);
    }
}
