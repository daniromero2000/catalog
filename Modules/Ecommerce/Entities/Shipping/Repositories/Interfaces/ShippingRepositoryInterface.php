<?php

namespace Modules\Ecommerce\Entities\Shipping\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Illuminate\Support\Collection;

interface ShippingRepositoryInterface
{
    public function setPickupAddress();

    public function setDeliveryAddress(CustomerAddress $address);

    public function readyParcel(Collection $collection);

    public function getRates(string $shipmentObjId, string $currency = 'COP');

    public function readyShipment();
}
