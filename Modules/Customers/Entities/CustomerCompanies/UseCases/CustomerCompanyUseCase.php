<?php

namespace Modules\Customers\Entities\CustomerCompanies\UseCases;

use Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces\CustomerCompanyRepositoryInterface;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\CreateCustomerCompanyErrorException;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\CustomerCompanyNotFoundException;
use Modules\Customers\Entities\CustomerCompanies\Exceptions\DeletingCustomerCompanyErrorException;
use Modules\Customers\Entities\CustomerCompanies\Repositories\CustomerCompanyRepository;
use Modules\Customers\Entities\CustomerCompanies\UseCases\Interfaces\CustomerCompanyUseCaseInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CustomerCompanyUseCase implements CustomerCompanyUseCaseInterface
{
    private $customerCompanyInterface, $customerStatusesLogServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CustomerCompanyRepositoryInterface $customerCompanyRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface,
        ProvinceRepositoryInterface $provinceRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        CustomerStatusesLogUseCaseInterface $customerStatusesLogUseCaseInterface
    ) {
        $this->toolsInterface                      = $toolRepositoryInterface;
        $this->customerCompanyInterface            = $customerCompanyRepositoryInterface;
        $this->customerStatusesLogServiceInterface = $customerStatusesLogUseCaseInterface;
        $this->countryInterface                    = $countryRepositoryInterface;
        $this->cityInterface                       = $cityRepositoryInterface;
        $this->customerInterface                   = $customerRepositoryInterface;
        $this->provinceInterface                   = $provinceRepositoryInterface;
        $this->module                              = 'Empresas Clientes';
    }

    public function listCustomerCompanies(array $requestData)
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($requestData);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'customer_companies' => $this->customerCompanyInterface->searchCustomerCompanies($searchData['q']),
                'optionsRoutes'      => config('generals.optionRoutes'),
                'module'             => $this->module,
                'headers'            => ['Cliente', 'Nombre Legal / Nombre Comercial', 'Tipo de Constitución', 'Aprobado / Activo', 'Opciones'],
                'cities'             => $this->cityInterface->getAllCityNames(),
                'customers'          => $this->customerInterface->getAllCustomerNames(),
                'countries'          => $this->countryInterface->getCountriesNames(),
                'provinces'          => $this->provinceInterface->getAllProvincesPrefixes(),
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCustomerCompany()
    {
        return [
            'data' => [
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'cities'        => $this->cityInterface->getAllCityNames(),
                'customers'     => $this->customerInterface->getAllCustomerNames()
            ]
        ];
    }

    public function storeCustomerCompany(array $requestData)
    {
        $this->customerCompanyInterface->createCustomerCompany($requestData);
    }

    public function updateCustomerCompany($request, int $id)
    {
        $customerCompany = $this->update($request, $id);
        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customerCompany->customer_id, 'Compañia Actualizada');
    }

    public function updateFrontCustomerCompany($request, int $id)
    {
        $customerCompany = $this->update($request, $id);
        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($customerCompany->customer_id, 'Compañia Actualizada');
    }

    private function update($request, int $id)
    {
        $customerCompany = $this->customerCompanyInterface->findCustomerCompanyById($id);

        $requestData = $request->except(
            '_token',
            '_method',
        );

        $update = new CustomerCompanyRepository($customerCompany);
        if ($request->hasFile('file')) {
            if ($customerCompany->file) {
                $this->toolsInterface->deleteThumbFromServer($customerCompany->file);
            }
            $requestData['file'] = $update->saveCompanyCertificate($request->file('file'), $customerCompany->company_id_number);
        }

        if ($request->hasFile('logo')) {
            if ($customerCompany->logo) {
                $this->toolsInterface->deleteThumbFromServer($customerCompany->logo);
            }
            $requestData['logo'] = $update->saveCompanyCertificate($request->file('logo'), $customerCompany->company_id_number);
        }
        $update->updateCustomerCompany($requestData);

        return $customerCompany;
    }

    public function deleteCustomerCompany(int $id)
    {
        $this->customerCompanyInterface->findCustomerCompanyById($id)->delete();
    }
}
