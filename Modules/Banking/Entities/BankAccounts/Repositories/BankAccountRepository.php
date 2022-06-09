<?php

namespace Modules\Banking\Entities\BankAccounts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Banking\Entities\BankAccounts\BankAccount;
use Modules\Banking\Entities\BankAccounts\Exceptions\BankAccountNotFoundException;
use Modules\Banking\Entities\BankAccounts\Exceptions\CreateBankAccountErrorException;
use Modules\Banking\Entities\BankAccounts\Exceptions\DeletingBankAccountErrorException;
use Modules\Banking\Entities\BankAccounts\Exceptions\UpdateBankAccountErrorException;
use Modules\Banking\Entities\BankAccounts\Repositories\Interfaces\BankAccountRepositoryInterface;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'account_number', 'is_active', 'created_at'];

    public function __construct(BankAccount $bankAccount)
    {
        $this->model = $bankAccount;
    }

    public function createBankAccount(array $data): BankAccount
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBankAccountErrorException($e->getMessage());
        }
    }

    public function updateBankAccount(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBankAccountErrorException($e->getMessage());
        }
    }

    public function findBankAccountById(int $bankAccountid): BankAccount
    {
        try {
            return $this->model->with(['bank', 'bankMovements'])
                ->findOrFail($bankAccountid, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new BankAccountNotFoundException($e->getMessage());
        }
    }

    public function deleteBankAccount(): bool
    {
        try {
            return  $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingBankAccountErrorException($e->getMessage());
        }
    }

    public function searchBankAccounts(string $text = null, $from = null, $to = null): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listBankAccounts();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchBankAccounts($text)->with(['bank'])
                ->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->with(['bank'])
                ->whereBetween('created_at', [$from, $to])
                ->select($this->columns)->paginate(10);
        }

        return $this->model->searchBankAccounts($text)->with(['bank'])
            ->whereBetween('created_at', [$from, $to])->select($this->columns)
            ->paginate(10);
    }

    private function listBankAccounts(): LengthAwarePaginator
    {
        return  $this->model->with(['bank'])->orderBy('created_at', 'desc')
            ->select($this->columns)->paginate(10);
    }

    public function findActiveBankAccounts(): Collection
    {
        return $this->model->with(['bank'])->where('is_active', 1)
            ->get($this->columns);
    }
}
