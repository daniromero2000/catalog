<?php

namespace Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;

interface CustomerAddressRepositoryInterface
{
    public function createCustomerAddress(array $data);

    public function deleteCustomerAddress($id);

    public function updateCustomerAddress($id);

    public function updateOrCreate($data);

    public function findAddressById(int $id): CustomerAddress;
}
