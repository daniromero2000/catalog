<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\UseCases;

use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\CustomerBankAccountRepository;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\Interfaces\CustomerBankAccountRepositoryInterface;
use Modules\Customers\Entities\CustomerBankAccounts\UseCases\Interfaces\CustomerBankAccountUseCaseInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CustomerBankAccountUseCase implements CustomerBankAccountUseCaseInterface
{
    private $customerBankAccountInterface, $toolsInterface, $bankInterface, $customerInterface;
    private $customerStatusesLogServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerBankAccountRepositoryInterface $customerBankAccountRepositoryInterface,
        CustomerStatusesLogUseCaseInterface $customerStatusesLogUseCaseInterface
    ) {
        $this->toolsInterface                      = $toolRepositoryInterface;
        $this->customerBankAccountInterface        = $customerBankAccountRepositoryInterface;
        $this->module                              = 'Cuentas Bancarias';
        $this->bankInterface                       = $bankRepositoryInterface;
        $this->customerInterface                   = $customerRepositoryInterface;
        $this->customerStatusesLogServiceInterface = $customerStatusesLogUseCaseInterface;
    }

    public function listCustomerBankAccounts(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'customerBankAccounts' => $this->customerBankAccountInterface->searchCustomerBankAccounts($searchData['q']),
                'banks'                => $this->bankInterface->getAllBankNames(),
                'customers'            => $this->customerInterface->getAllCustomerNames(),
                'optionsRoutes'        => config('generals.optionRoutes'),
                'module'               => $this->module,
                'headers'              => ['Cliente', 'Banco', 'Número Cuenta', 'Aprobado', 'Activo', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCustomerBankAccount()
    {
        return [
            'data' => [
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'banks'         => $this->bankInterface->getAllBankNames(),
                'customers'     => $this->customerInterface->getAllCustomerNames()
            ]
        ];
    }

    public function storeCustomerBankAccount(array $requestData)
    {
        $customerBankAccount = $this->customerBankAccountInterface->createCustomerBankAccount($requestData);
        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customerBankAccount->customer_id, 'Cuenta Bancaria Creada');
    }

    public function storeFrontCustomerBankAccount(array $requestData)
    {
        $customerBankAccount = $this->customerBankAccountInterface->createCustomerBankAccount($requestData);
        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($customerBankAccount->customer_id, 'Cuenta Bancaria Creada');
    }

    public function updateCustomerBankAccount($request, int $id)
    {
        $customerBankAccount = $this->update($request, $id);
        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customerBankAccount->customer_id, 'Cuenta Bancaria Creada');
    }

    public function updateFrontCustomerBankAccount($request, int $id)
    {
        $customerBankAccount = $this->update($request, $id);
        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($customerBankAccount->customer_id, 'Cuenta Bancaria Creada');
    }

    private function update($request, int $id)
    {
        $customerBankAccount = $this->customerBankAccountInterface->findCustomerBankAccountById($id);

        $requestData = $request->except(
            '_token',
            '_method',
        );

        $update = new CustomerBankAccountRepository($customerBankAccount);

        if ($request->hasFile('account_certificate')) {
            if ($customerBankAccount->account_certificate) {
                $this->toolsInterface->deleteThumbFromServer($customerBankAccount->account_certificate);
            }
            $requestData['account_certificate'] = $update->saveAccountCertificate($request->file('account_certificate'), $customerBankAccount->account_number);
        }

        $update->updateCustomerBankAccount($requestData);

        return $customerBankAccount;
    }

    public function destroyCustomerBankAccount(int $id)
    {
        $this->customerBankAccountInterface->findCustomerBankAccountById($id)->delete();
    }
}
