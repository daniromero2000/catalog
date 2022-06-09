<?php

namespace Modules\Customers\Entities\Customers\UseCases;

use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\Customers\UseCases\Interfaces\CustomerUseCaseInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;

class CustomerUseCase implements CustomerUseCaseInterface
{
    private $customerInterface;
    private $customerStatusesLogServiceInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusesLogUseCaseInterface $customerStatusesLogUseCaseInterface
    ) {
        $this->customerInterface                   = $customerRepositoryInterface;
        $this->module                              = 'Cuentas Bancarias';
        $this->customerInterface                   = $customerRepositoryInterface;
        $this->customerStatusesLogServiceInterface = $customerStatusesLogUseCaseInterface;
    }

    public function updateCustomerPassword($request, int $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);
        $update   = new CustomerRepository($customer);
        $data     = $request->except('customer_channel', 'customer_status', '_method', '_token', 'password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        unset($customer->age);
        $update->updateCustomer($data);

        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customer->id, 'Contraseña Asignada');
    }
}
