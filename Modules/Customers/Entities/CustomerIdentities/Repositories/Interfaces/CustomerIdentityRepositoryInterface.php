<?php

namespace Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;

interface CustomerIdentityRepositoryInterface
{
    public function createCustomerIdentity(array $data);

    public function checkIfExists($data);

    public function updateOrCreate($data);

    public function findCustomerIdentityById(int $id): CustomerIdentity;

    public function updateCustomerIdentity(array $data): bool;
}
