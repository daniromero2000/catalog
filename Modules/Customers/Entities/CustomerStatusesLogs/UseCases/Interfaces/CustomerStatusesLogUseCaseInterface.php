<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces;

interface CustomerStatusesLogUseCaseInterface
{
    public function storeCustomerStatusesLog($id, $status);

    public function storeFrontCustomerStatusesLog($id, $status);
}
