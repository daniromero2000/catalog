<?php

namespace Modules\Ecommerce\Entities\Orders\Transformers;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\CustomerAddresses\Repositories\CustomerAddressRepository;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;

trait OrderTransformable
{
    protected function transformOrder(Order $order): Order
    {
        $courierRepo = new CourierRepository(new Courier());
        $order->courier = $courierRepo->findCourierById($order->courier_id);

        $customerRepo = new CustomerRepository(new Customer());
        $order->customer = $customerRepo->findCustomerById($order->customer_id);

        $addressRepo = new CustomerAddressRepository(new CustomerAddress());
        $order->address = $addressRepo->findAddressById($order->address_id);

        $orderStatusRepo = new OrderStatusRepository(new OrderStatus());
        $order->status = $orderStatusRepo->findOrderStatusById($order->order_status_id);

        return $order;
    }
}
