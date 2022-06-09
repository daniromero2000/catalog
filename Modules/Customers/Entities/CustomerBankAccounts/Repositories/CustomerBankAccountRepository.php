<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerBankAccounts\CustomerBankAccount;
use Modules\Customers\Entities\CustomerBankAccounts\Exceptions\CustomerBankAccountNotFoundException;
use Modules\Customers\Entities\CustomerBankAccounts\Exceptions\CreateCustomerBankAccountErrorException;
use Modules\Customers\Entities\CustomerBankAccounts\Exceptions\DeletingCustomerBankAccountErrorException;
use Modules\Customers\Entities\CustomerBankAccounts\Exceptions\UpdateCustomerBankAccountErrorException;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\Interfaces\CustomerBankAccountRepositoryInterface;
use PhpParser\Node\Expr\FuncCall;

class CustomerBankAccountRepository implements CustomerBankAccountRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'customer_id',
        'bank_id',
        'account_type',
        'account_number',
        'account_certificate',
        'customer_identity_id',
        'is_active',
        'is_aprobed',
        'created_at'
    ];

    public function __construct(CustomerBankAccount $contract)
    {
        $this->model = $contract;
    }

    public function createCustomerBankAccount(array $data): CustomerBankAccount
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCustomerBankAccountErrorException($e->getMessage());
        }
    }

    public function updateCustomerBankAccount(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCustomerBankAccountErrorException($e->getMessage());
        }
    }

    public function findCustomerBankAccountById(int $id): CustomerBankAccount
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CustomerBankAccountNotFoundException($e->getMessage());
        }
    }

    public function deleteCustomerBankAccount(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCustomerBankAccountErrorException($e->getMessage());
        }
    }

    public function searchCustomerBankAccounts(string $text = null)
    {
        if (is_null($text)) {
            return $this->listCustomerBankAccounts($this->columns);
        }
        return $this->model->searchCustomerBankAccounts($text)
            ->with(['customer', 'bankNames'])
            ->select($this->columns)
            ->paginate(10);
    }

    public function listCustomerBankAccounts()
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->with(['customer', 'bankNames'])
            ->select($this->columns)
            ->paginate(10);
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['customer_id' => $data['customer_id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function saveAccountCertificate(UploadedFile $file, $account): string
    {
        return $file->store('customer-bank-accounts/' . $account, ['disk' => 'public']);
    }

    public function getCustomerBankAccounts(int $id)
    {
        return $this->model->with('bankNames')
            ->where('customer_id', $id)
            ->where('is_aprobed', 1)
            ->where('is_active', 1)
            ->get(['id', 'account_type', 'account_number', 'bank_id']);
    }
}
