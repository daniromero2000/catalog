<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;
use Modules\XisfoPay\Entities\ContractRenewals\Exceptions\ContractRenewalInvalidArgumentException;
use Modules\XisfoPay\Entities\ContractRenewals\Exceptions\ContractRenewalNotFoundException;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\Interfaces\ContractRenewalRepositoryInterface;
use Modules\XisfoPay\Mail\ContractRenewals\SendNewRenewalEmailNotificationToAdmin;

class ContractRenewalRepository implements ContractRenewalRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'starts',
        'expires',
        'file',
        'contract_id',
        'contract_rate_id',
        'is_special_price',
        'is_aprobed',
        'is_active',
        'created_at',
        'id'
    ];

    public function __construct(ContractRenewal $contractRenewal)
    {
        $this->model = $contractRenewal;
    }

    public function createContractRenewal(array $data): ContractRenewal
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new ContractRenewalInvalidArgumentException($e->getMessage());
        }
    }

    public function updateContractRenewal(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new ContractRenewalInvalidArgumentException($e->getMessage());
        }
    }

    public function findContractRenewalById(int $id): ContractRenewal
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractRenewalNotFoundException($e->getMessage());
        }
    }

    public function deleteContractRenewal(): bool
    {
        return $this->model->delete();
    }

    public function searchContractRenewal(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractRenewals();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchContractRenewals($text)
                ->with(['contract', 'contractRate'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['contract', 'contractRate'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchContractRenewals($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['contract', 'contractRate'])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function listContractRenewals()
    {
        return  $this->model->select($this->columns)
            ->with(['contract', 'contractRate'])
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function findUnapprobedContractRenewals(): Collection
    {
        return $this->model->where('is_aprobed', 0)
            ->orderBy('id', 'asc')
            ->get($this->columns);
    }

    public function findExpiredContractRenewals(): Collection
    {
        return $this->model->with(['contract'])
            ->where('expires', '<', Carbon::now())
            ->where('is_active', 1)
            ->where('is_aprobed', 1)
            ->orderBy('id', 'asc')
            ->get($this->columns);
    }

    public function sendNewRenewalEmailNotificationToAdmin()
    {
        Mail::to(['email' => 'carlosq.syc@gmail.com'])->cc(['financiero0.syc@gmail.com'])
            ->queue(new SendNewRenewalEmailNotificationToAdmin($this->findContractRenewalById($this->model->id)));
    }
}
