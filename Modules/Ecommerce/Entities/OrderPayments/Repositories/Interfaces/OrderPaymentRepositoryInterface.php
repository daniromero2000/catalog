<?php

namespace Modules\Ecommerce\Entities\OrderPayments\Repositories\Interfaces;

use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;

interface OrderPaymentRepositoryInterface
{
    public function createOrderPayment(array $data): OrderPayment;
}
