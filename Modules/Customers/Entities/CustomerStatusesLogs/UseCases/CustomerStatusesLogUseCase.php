<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs\UseCases;

use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;

class CustomerStatusesLogUseCase implements CustomerStatusesLogUseCaseInterface
{
    private $customerStatusesLogInterface;

    public function __construct(
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function storeCustomerStatusesLog($id, $status)
    {
        $data = array(
            'customer_id' => $id,
            'status'      => $status,
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
    }


    public function storeFrontCustomerStatusesLog($id, $status)
    {
        $data = array(
            'customer_id' => $id,
            'status'      => $status,
            'employee_id' => 57
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
    }
}
