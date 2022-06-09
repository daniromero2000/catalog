<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\ContractRequestNotFoundException;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\CreateContractRequestErrorException;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\DeletingContractRequestErrorException;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\UpdateContractRequestErrorException;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Mail\ContractRequests\Front\SendNewRequestEmailNotificationCustomer;
use Modules\XisfoPay\Mail\ContractRequests\SendNewRequestEmailNotificationToAdmin;

class ContractRequestRepository implements ContractRequestRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'client_identifier',
        'customer_id',
        'contract_id',
        'file',
        'is_signed',
        'is_aprobed',
        'contract_request_status_id',
        'customer_company_id',
        'employee_id',
        'finantial_retention',
        'contract_request_type',
        'created_at',
        'is_bank_processing_commission_free'
    ];

    public function __construct(ContractRequest $contractStatus)
    {
        $this->model = $contractStatus;
    }

    public function createContractRequest(array $data): ContractRequest
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRequestErrorException($e->getMessage());
        }
    }

    public function updateContractRequest(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateContractRequestErrorException($e->getMessage());
        }
    }

    public function findContractRequestById(int $id): ContractRequest
    {
        try {
            return $this->model->with([
                'contract',
                'contractRequestStatus',
                'customer',
                'contractRequestStreamAccount',
                'employee',
                'customerCompany'
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ContractRequestNotFoundException($e->getMessage());
        }
    }

    public function listContractRequests()
    {
        if (auth()->guard('employee')->user()->hasRole('xisfopay_comercial')) {
            return  $this->model
                ->where('employee_id', auth()->guard('employee')->user()->id)
                ->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')->select($this->columns)
                ->paginate(10);
        } else {
            return  $this->model->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')->select($this->columns)
                ->paginate(10);
        }
    }

    public function listContractRequestsFront($id): Collection
    {
        return $this->model->where('customer_id', $id)
            ->with(['contractRequestStatus'])
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function deleteContractRequest(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingContractRequestErrorException($e->getMessage());
        }
    }

    public function searchContractRequest(string $text = null,  $from = null, $to = null)
    {
        if (auth()->guard('employee')->user()->hasRole('xisfopay_comercial')) {
            return $this->searchRequestsforCommercial($text,  $from, $to);
        } else {
            return $this->searchAllRequests($text, $from, $to);
        }
    }

    public function searchRequestsforCommercial($text, $from, $to)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractRequests();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchContractRequest($text)
                ->where('employee_id', auth()->guard('employee')->user()->id)
                ->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->where('employee_id', auth()->guard('employee')->user()->id)
                ->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchContractRequest($text)
            ->where('employee_id', auth()->guard('employee')->user()->id)
            ->with(['customer', 'contractRequestStatus'])
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->select($this->columns)
            ->paginate(10);
    }

    public function searchAllRequests($text, $from, $to)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listContractRequests();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchContractRequest($text)
                ->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['customer', 'contractRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchContractRequest($text)
            ->with(['customer', 'contractRequestStatus'])
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->select($this->columns)
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

    public function listIds(): Collection
    {
        return $this->model->orderBy('id', 'asc')->where('is_active', 1)
            ->get($this->columns);
    }

    public function getAllContractRequestNames()
    {
        return $this->model
            ->where('is_active', 1)
            ->orderBy('updated_at', 'asc')
            ->get(['id', 'client_identifier', 'is_active']);
    }

    public function findUnapprobedContractRequests(): Collection
    {
        return $this->model->with(['customer'])
            ->where('is_aprobed', 0)
            ->orWhere('contract_request_status_id', '!=', 5)
            ->get($this->columns);
    }

    public function sendNewRequestEmailNotificationToAdmin()
    {
        Mail::to(['email' => 'aux.mercadeo.xisfo@gmail.com'])
            ->queue(new SendNewRequestEmailNotificationToAdmin($this->findContractRequestById($this->model->id)));
    }

    public function sendNewRequestRegisterToCostumer($link, $contractRequest)
    {
        Mail::to(['email' => 'desarrollador1.syc@gmail.com', $contractRequest->customer->email])
            ->queue(new SendNewRequestEmailNotificationCustomer($this->model, $link));
    }

    public function getCustomerContractRequests(int $customerId)
    {
        $contract_requests_ids = $this->model
            ->where('customer_id', $customerId)
            ->get(['id']);
        $ids_array = [];

        foreach ($contract_requests_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }

    public function findCustomerContractRequests(int $customerId, $contract_request_type)
    {
        switch ($contract_request_type) {
            case 'Natural':
                $contract_request_type = 2;
                break;
            case 'Jurídica':
                $contract_request_type = 1;
                break;
            case 'Tokens':
                $contract_request_type = 3;
                break;
        }

        return $this->model
            ->where('customer_id', $customerId)
            ->where('contract_request_type', $contract_request_type)
            ->exists();
    }

    public function getCustomerContracts(int $customer_id)
    {
        $contracts_ids = $this->model
            ->where('customer_id', $customer_id)
            ->get(['contract_id']);
        $ids_array = [];

        foreach ($contracts_ids as $value) {
            array_push($ids_array, $value->contract_id);
        }

        return $ids_array;
    }
}
