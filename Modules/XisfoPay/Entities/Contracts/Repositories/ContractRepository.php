<?php

namespace Modules\XisfoPay\Entities\Contracts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\Contracts\Contract;
use Modules\XisfoPay\Entities\Contracts\Exceptions\ContractNotFoundException;
use Modules\XisfoPay\Entities\Contracts\Exceptions\CreateContractErrorException;
use Modules\XisfoPay\Entities\Contracts\Exceptions\DeletingContractErrorException;
use Modules\XisfoPay\Entities\Contracts\Exceptions\UpdateContractErrorException;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;
use Modules\XisfoPay\Mail\Contracts\SendInActiveContractsEmailNotificationToAdmin;

class ContractRepository implements ContractRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'contract_status_id',
        'is_signed',
        'is_active',
        'is_aprobed',
        'created_at'
    ];

    public function __construct(Contract $contract)
    {
        $this->model = $contract;
    }

    public function createContract(array $data): Contract
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractErrorException($e->getMessage());
        }
    }

    public function updateContract(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateContractErrorException($e->getMessage());
        }
    }

    public function findContractById(int $id): Contract
    {
        try {
            return $this->model->with([
                'contractCommentaries',
                'contractStatusesLogs',
                'contractRequests',
                'contractRenewals',
                'contractStatus'
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractNotFoundException($e->getMessage());
        }
    }

    public function deleteContract(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingContractErrorException($e->getMessage());
        }
    }

    public function searchContract(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContracts();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchContract($text)
                ->with(['contractRequests', 'contractStatus'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['contractRequests', 'contractStatus'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }

        return $this->model->searchContract($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['contractRequests', 'contractStatus'])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function listContracts()
    {
        return  $this->model->select($this->columns)
            ->with(['contractRequests', 'contractStatus'])
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function activateContract($contract)
    {
        $contract->is_active = 1;
        return $contract->save();
    }

    public function findInActiveContracts(): Collection
    {
        return $this->model->where('is_active', 0)
            ->orWhere('contract_status_id', '!=', 4)
            ->orderBy('id', 'asc')->get($this->columns);
    }

    public function checkIfInActiveContracts()
    {
        $inActiveContracts = $this->findInActiveContracts();

        if (!$inActiveContracts->isEmpty()) {
            $this->sendInActiveContractsEmailNotificationToAdmin($inActiveContracts);
        }

        return true;
    }

    public function sendInActiveContractsEmailNotificationToAdmin($data)
    {
        Mail::to(['aux.mercadeo.xisfo@gmail.com'])->cc([
            'carlosq.syc@gmail.com',
            'financiero0.syc@gmail.com'
        ])->queue(new SendInActiveContractsEmailNotificationToAdmin($data));
    }

    public function setUpdateLogStatus($contract, $request)
    {
        if ($contract->contractStatus->id == $request['contract_status_id']) {
            $status = 'Contrato Actualizado';
        } else {
            $contract->setRelations(['contractStatus']);
            $status = $contract->contractStatus->name;
        }

        return $status;
    }

    public function getCustomerContracts($contract_requests_ids)
    {
        $contracts_ids = $this->model
            ->whereIn('contract_request_id', $contract_requests_ids)
            ->get(['id']);
        $ids_array = [];

        foreach ($contracts_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }

    public function listContractsByCustomerId($contracts_ids)
    {
        return  $this->model
            ->with(['contractRequests', 'contractStatus'])
            ->whereIn('id', $contracts_ids)
            ->orderBy('created_at', 'desc')->select($this->columns)
            ->paginate(10);
    }

    public function searchContractsByCustomerId(string $text = null, $contracts_ids)
    {
        if (is_null($text)) {
            return $this->listContractsByCustomerId($contracts_ids);
        }
    }
}
