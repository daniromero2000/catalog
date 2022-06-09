<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories;

use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\ContractRequestStreamAccount;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Exceptions\CreateContractRequestStreamAccountErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class ContractRequestStreamAccountRepository implements ContractRequestStreamAccountRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'contract_request_id',
        'contract_request_stream_account_commission_id',
        'streaming_id',
        'nickname',
        'set_up',
        'is_active'
    ];

    public function __construct(ContractRequestStreamAccount $contractRequestStreamAccounts)
    {
        $this->model = $contractRequestStreamAccounts;
    }

    public function createContractRequestStreamAccount(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRequestStreamAccountErrorException($e->getMessage());
        }
    }

    public function searchContractRequestStreamAccount(string $text = null, int $commercialId = null)
    {
        if (is_null($text)) {
            return $this->listContractRequestStreamAccounts($commercialId);
        }

        return $this->model->searchContractRequestStreamAccount($text)
            ->with(['contractRequest', 'streaming', 'contractRequestStreamAccountCommission'])
            ->select($this->columns)
            ->where(function ($q) use ($commercialId) {
                if ($commercialId != null) {
                    $q->whereHas('contractRequest', function ($k) use ($commercialId) {
                        $k->where('employee_id', $commercialId);
                    });
                }
            })
            ->paginate(10);
    }

    public function listContractRequestStreamAccounts($commercialId)
    {
        return  $this->model->with(['contractRequest', 'streaming', 'contractRequestStreamAccountCommission'])
            ->orderBy('nickname', 'desc')
            ->select($this->columns)
            ->where(function ($q) use ($commercialId) {
                if ($commercialId != null) {
                    $q->whereHas('contractRequest', function ($k) use ($commercialId) {
                        $k->where('employee_id', $commercialId);
                    });
                }
            })
            ->paginate(10);
    }

    public function findContractRequestStreamAccountById(int $id): ContractRequestStreamAccount
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateContractRequestStreamAccount(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteContractRequestStreamAccount(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getAllStreamAccountNames(): Collection
    {
        return $this->model->with(['contractRequest', 'streaming'])
            ->where('set_up', 1)->where('is_active', 1)
            ->whereHas('contractRequest', function ($q) {
                $q->whereHas('contract', function ($q1) {
                    $q1->whereHas('contractRenewals', function ($q2) {
                        $q2->where('is_active', 1);
                    });
                });
            })
            ->orderBy('contract_request_id', 'asc')->get($this->columns);
    }

    public function activateStreamingAccounts($contractRequestStreamAccount)
    {
        $contractRequestStreamAccount->each(function ($stream) {
            $stream->is_active = 1;
            $stream->save();
        });
    }

    public function getCustomerStreamAccounts($contract_requests_ids)
    {
        $stream_accounts_ids = $this->model
            ->whereIn('contract_request_id', $contract_requests_ids)
            ->get(['id']);
        $ids_array = [];

        foreach ($stream_accounts_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }

    public function getCustomerStreamAccountsNames($contract_requests_ids): Collection
    {
        return $this->model->with(['contractRequest', 'streaming'])
            ->whereIn('contract_request_id', $contract_requests_ids)
            ->where('set_up', 1)->where('is_active', 1)
            ->whereHas('contractRequest', function ($q) {
                $q->whereHas('contract', function ($q1) {
                    $q1->whereHas('contractRenewals', function ($q2) {
                        $q2->where('is_active', 1);
                    });
                });
            })
            ->orderBy('nickname', 'asc')->get($this->columns);
    }

    public function findStreamingContractRequests(int $streamingId): Collection
    {
        return $this->model->with(['contractRequest', 'streaming'])
            ->where('is_active', 1)->where('streaming_id', $streamingId)
            ->get($this->columns);
    }
}
