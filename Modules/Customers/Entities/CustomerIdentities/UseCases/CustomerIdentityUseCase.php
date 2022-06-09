<?php

namespace Modules\Customers\Entities\CustomerIdentities\UseCases;

use Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces\CustomerCompanyRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Exceptions\CreateCustomerIdentityErrorException;
use Modules\Customers\Entities\CustomerIdentities\Exceptions\CustomerIdentityNotFoundException;
use Modules\Customers\Entities\CustomerIdentities\Repositories\CustomerIdentityRepository;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\UseCases\Interfaces\CustomerIdentityUseCaseInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CustomerIdentityUseCase implements CustomerIdentityUseCaseInterface
{
    private $customerIdentityInterface, $customerCompanyInterface;
    private $customerStatusesLogServiceInterface, $toolsInterface;

    public function __construct(
        CustomerIdentityRepositoryInterface $customerIdentityRepositoryInterface,
        CustomerCompanyRepositoryInterface $customerCompanyRepositoryInterface,
        CustomerStatusesLogUseCaseInterface $customerStatusesLogUseCaseInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {

        $this->customerIdentityInterface           = $customerIdentityRepositoryInterface;
        $this->customerCompanyInterface            = $customerCompanyRepositoryInterface;
        $this->customerStatusesLogServiceInterface = $customerStatusesLogUseCaseInterface;
        $this->toolsInterface                      = $toolRepositoryInterface;
        $this->module                              = 'Identificación Clientes';
    }

    public function createCustomerIdentity()
    {
        return [
            'data' => [
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module
            ]
        ];
    }

    public function storeCustomerIdentity($request)
    {
        $identity = $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));

        $this->saveRutNitOnCustomerCompany($identity);
        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($identity->customer->id, 'Identidad Agregada');
        return back()->with('message', config('messaging.create'));
    }

    public function storeFrontCustomerIdentity($request)
    {
        $identity = $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));

        $this->saveRutNitOnCustomerCompany($identity);
        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($identity->customer->id, 'Identidad Agregada');
        return back()->with('message', config('messaging.create'));
    }

    public function updateCustomerIdentity($request, int $id)
    {
        $customerIdentity = $this->update($request, $id);

        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customerIdentity->customer_id, 'Identidad Actualizada');
    }

    public function updateFrontCustomerIdentity($request, int $id)
    {
        $customerIdentity = $this->update($request, $id);

        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($customerIdentity->customer_id, 'Identidad Actualizada');
    }

    private function update($request, int $id)
    {
        $customerIdentity = $this->customerIdentityInterface->findCustomerIdentityById($id);

        $requestData = $request->except(
            '_token',
            '_method',
        );

        $update = new CustomerIdentityRepository($customerIdentity);
        if ($request->hasFile('file')) {
            if ($customerIdentity->file) {
                $this->toolsInterface->deleteThumbFromServer($customerIdentity->file);
            }
            $requestData['file'] = $update->saveIdFile($request->file('file'), $customerIdentity->identity_number);
        }
        $update->updateCustomerIdentity($requestData);

        return $customerIdentity;
    }

    private function saveRutNitOnCustomerCompany($identity)
    {
        if ($identity->identity_type_id == 5 || $identity->identity_type_id == 6) {
            $data = array(
                'customer_id' => $identity->customer->id,
                'company_id_number' => $identity->identity_number
            );
            return $this->customerCompanyInterface->updateOrCreate($data);
        }
    }
}
