<?php

namespace Modules\Customers\Entities\CustomerEmails\Repositories;

use Modules\Customers\Entities\CustomerEmails\CustomerEmail;
use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Customers\Entities\CustomerEmails\Exceptions\UpdateCustomerEmailErrorException;

class CustomerEmailRepository implements CustomerEmailRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerEmail $customerEmail)
    {
        $this->model = $customerEmail;
    }

    public function createCustomerEmail(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCustomerEmail($id)
    {
        try {
            return $this->model->where('id', $this->model->id)->update($id);
        } catch (QueryException $e) {
            throw new UpdateCustomerEmailErrorException($e->getMessage());
        }
    }


    public function findCustomerEmailById(int $id): CustomerEmail
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new EmailNotFoundException($e->getMessage());
        }
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['email' => $data['email']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
