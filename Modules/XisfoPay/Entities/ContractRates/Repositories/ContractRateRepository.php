<?php

namespace Modules\XisfoPay\Entities\ContractRates\Repositories;

use Modules\XisfoPay\Entities\ContractRates\ContractRate;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRates\Exceptions\CreateContractRateErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\ContractRates\Exceptions\ContractRateNotFoundException;

class ContractRateRepository implements ContractRateRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'percentage',
        'type',
        'value',
        'is_aprobed',
        'is_active'
    ];

    public function __construct(ContractRate $contractRate)
    {
        $this->model = $contractRate;
    }

    public function createContractRate(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRateErrorException($e->getMessage());
        }
    }

    public function getAllContractRates()
    {
        return $this->model->orderBy('id', 'asc')->get(['id', 'percentage']);
    }

    public function findContractRateById(int $id): ContractRate
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractRateNotFoundException($e->getMessage());
        }
    }

    public function updateContractRate(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteContractRate(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingBankErrorException($e->getMessage());
        }
    }

    public function searchContractRate(string $text = null)
    {
        if (is_null($text)) {
            return $this->listContractRates();
        } else {
            return $this->model->searchContractRate($text)
                ->select($this->columns)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
    }

    private function listContractRates()
    {
        return  $this->model
            ->select($this->columns)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }
}
