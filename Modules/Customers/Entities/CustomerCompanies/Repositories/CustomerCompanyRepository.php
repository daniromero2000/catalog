<?php

namespace Modules\Customers\Entities\CustomerCompanies\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerCompanies\CustomerCompany;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\CustomerCompanyNotFoundException;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\CreateCustomerCompanyErrorException;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\DeletingCustomerCompanyErrorException;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\UpdateCustomerCompanyErrorException;
use Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces\CustomerCompanyRepositoryInterface;

class CustomerCompanyRepository implements CustomerCompanyRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'customer_id',
        'constitution_type',
        'company_legal_name',
        'company_commercial_name',
        'company_id_number',
        'company_address',
        'neighborhood',
        'prefix',
        'company_phone',
        'city_id',
        'logo',
        'file',
        'is_active',
        'is_aprobed',
        'created_at'
    ];

    public function __construct(CustomerCompany $contract)
    {
        $this->model = $contract;
    }

    public function createCustomerCompany(array $data): CustomerCompany
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCustomerCompanyErrorException($e->getMessage());
        }
    }

    public function updateCustomerCompany(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCustomerCompanyErrorException($e->getMessage());
        }
    }

    public function findCustomerCompanyById(int $id): CustomerCompany
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CustomerCompanyNotFoundException($e->getMessage());
        }
    }

    public function deleteCustomerCompany(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCustomerCompanyErrorException($e->getMessage());
        }
    }

    public function searchCustomerCompanies(string $text = null)
    {
        if (is_null($text)) {
            return $this->listCustomerCompanies();
        }
        return $this->model->searchCustomerCompanies($text)
            ->with('customer')
            ->select($this->columns)
            ->paginate(10);
    }

    private function listCustomerCompanies()
    {
        return $this->model
            ->with('customer')
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
    public function countCustomerCompany(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            $data =  $this->model->get(['id']);
            return count($data);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            $data =  $this->model->searchCustomerCompanies($text)
                ->get(['id']);
            return count($data);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            $data =  $this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        }

        $data =  $this->model->searchCustomerCompanies($text)
            ->whereBetween('created_at', [$from, $to])
            ->get(['id']);
        return count($data);
    }

    public function saveCompanyCertificate(UploadedFile $file, $idNumber): string
    {
        return $file->store('customer_companies/' . $idNumber, ['disk' => 'public']);
    }

    public function enableCreateCompany($request, $customerCompanies)
    {
        if ($request['contract_request_type'] == 'Tokens' && !$customerCompanies->where('constitution_type', 'Natural')->isEmpty()) {
            return $customerCompanies->where('constitution_type', 'Natural')->first()->id;
        }
        if ($request['contract_request_type'] == 'Natural' && !$customerCompanies->where('constitution_type', 'Natural')->isEmpty()) {
            return $customerCompanies->where('constitution_type', 'Natural')->first()->id;
        }
        if ($request['contract_request_type'] == 'Jurídica' && !$customerCompanies->where('constitution_type', 'Jurídica')->isEmpty()) {
            return $customerCompanies->where('constitution_type', 'Jurídica')->first()->id;
        }
        return 0;
    }
}
