<?php

namespace Modules\Ecommerce\Entities\OrderStatusesLogs\Repositories\Interfaces;

use Modules\Ecommerce\Entities\OrderStatusesLogs\OrderStatusesLog;


interface OrderStatusesLogRepositoryInterface
{
    public function createOrderStatusesLog(array $data): OrderStatusesLog;
}
