<?php

namespace Modules\Banking\Entities\BankMovements\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Banking\Entities\BankMovements\BankMovement;
use Modules\Banking\Entities\BankMovements\Exceptions\BankMovementNotFoundException;
use Modules\Banking\Entities\BankMovements\Exceptions\CreateBankMovementErrorException;
use Modules\Banking\Entities\BankMovements\Exceptions\DeletingBankMovementErrorException;
use Modules\Banking\Entities\BankMovements\Exceptions\UpdateBankMovementErrorException;
use Modules\Banking\Entities\BankMovements\Repositories\Interfaces\BankMovementRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BankMovementRepository implements BankMovementRepositoryInterface
{
    protected $model;
    private $columns = [
        'id', 'bank_account_id', 'movement_type', 'amount', 'total_bank_amount',
        'trm', 'description', 'created_at'
    ];

    public function __construct(BankMovement $bankMovement)
    {
        $this->model = $bankMovement;
    }

    public function createBankMovement(array $data): BankMovement
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBankMovementErrorException($e->getMessage());
        }
    }

    public function updateBankMovement(array $data): bool
    {
        try {
            $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBankMovementErrorException($e->getMessage());
        }
    }

    public function findBankMovementById(int $bankMovementId): BankMovement
    {
        try {
            return $this->model->with(['bankAccount'])
                ->findOrFail($bankMovementId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new BankMovementNotFoundException($e->getMessage());
        }
    }

    public function deleteBankMovement(): bool
    {
        try {
            $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingBankMovementErrorException($e->getMessage());
        }
    }

    public function searchBankMovements(string $text = null, $from = null, $to = null): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listBankMovements();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchBankMovements($text)->with(['bankAccount'])
                ->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->with(['bankAccount'])
                ->whereBetween('created_at', [$from, $to])
                ->select($this->columns)->paginate(10);
        }

        return $this->model->searchBankMovements($text)->with(['bankAccount'])
            ->whereBetween('created_at', [$from, $to])->select($this->columns)
            ->paginate(10);
    }

    private function listBankMovements(): LengthAwarePaginator
    {
        return  $this->model->with(['bankAccount'])->orderBy('created_at', 'desc')
            ->select($this->columns)->paginate(10);
    }

    public function findLastBankMovement($bankAccountId): ?BankMovement
    {
        return $this->model->orderBy('id', 'desc')
            ->where('bank_account_id', $bankAccountId)
            ->get($this->columns)->first();
    }
}
