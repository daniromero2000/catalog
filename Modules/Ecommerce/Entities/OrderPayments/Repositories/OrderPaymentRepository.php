<?php

namespace Modules\Ecommerce\Entities\OrderPayments\Repositories;

use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;
use Modules\Ecommerce\Entities\OrderPayments\Repositories\Interfaces\OrderPaymentRepositoryInterface;

class OrderPaymentRepository implements OrderPaymentRepositoryInterface
{
    protected $model;
    private $columns = [
        'name',
        'method',
        'description',
        'transaction_id',
        'transaction_order',
        'state',
        'order_id'
    ];

    public function __construct(OrderPayment $orderPayment)
    {
        $this->model = $orderPayment;
    }

    public function createOrderPayment(array $data): OrderPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBrandErrorException($e->getMessage());
        }
    }
}
