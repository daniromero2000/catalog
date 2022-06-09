<?php

namespace Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces;

interface CustomerEmailRepositoryInterface
{
    public function createCustomerEmail(array $data);

    public function updateOrCreate($data);

    public function updateCustomerEmail($id);

    public function findCustomerEmailById(int $id);
}
