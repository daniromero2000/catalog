<?php

namespace Modules\Banking\Entities\Banks\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Banking\Entities\Banks\Bank;
use Modules\Banking\Entities\Banks\Exceptions\BankNotFoundException;
use Modules\Banking\Entities\Banks\Exceptions\CreateBankErrorException;
use Modules\Banking\Entities\Banks\Exceptions\DeletingBankErrorException;
use Modules\Banking\Entities\Banks\Exceptions\UpdateBankErrorException;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;

class BankRepository implements BankRepositoryInterface
{
    protected $model;
    private $columns = [
        'id', 'name', 'country_id', 'is_active', 'created_at',
        'transfer_rate', 'draft_rate'
    ];

    public function __construct(Bank $bank)
    {
        $this->model = $bank;
    }

    public function createBank(array $data): Bank
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBankErrorException($e->getMessage());
        }
    }

    public function updateBank(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBankErrorException($e->getMessage());
        }
    }

    public function findBankById(int $bankId): Bank
    {
        try {
            return $this->model->findOrFail($bankId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new BankNotFoundException($e->getMessage());
        }
    }

    public function deleteBank(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingBankErrorException($e->getMessage());
        }
    }

    public function searchBank(string $text = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listBanks();
        } else {
            return $this->model->searchBank($text)->select($this->columns)
                ->orderBy('name', 'desc')->paginate(10);
        }
    }

    private function listBanks(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)->orderBy('name', 'asc')
            ->paginate(10);
    }

    public function getAllBankNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
    }

    public function getBankDraftRate(int $bankId): Bank
    {
        return $this->model->select('draft_rate')->where('id', $bankId)->first();
    }

    public function findBankProcessingCommission($bankId): Bank
    {
        return $this->model->where('id', $bankId)
            ->get('bank_processing_commission')->first();
    }
}
