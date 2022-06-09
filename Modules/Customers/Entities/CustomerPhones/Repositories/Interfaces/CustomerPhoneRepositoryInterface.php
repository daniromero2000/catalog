<?php

namespace Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces;

interface CustomerPhoneRepositoryInterface
{
    public function createCustomerPhone(array $data);

    public function checkIfExists($data);

    public function findCustomerPhoneById(int $id);

    public function updateOrCreate($data);
}
