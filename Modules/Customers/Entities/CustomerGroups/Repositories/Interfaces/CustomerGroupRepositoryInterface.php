<?php

namespace Modules\Customers\Entities\CustomerGroups\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerGroups\CustomerGroup;

interface CustomerGroupRepositoryInterface
{
    public function createCustomerGroup(array $data): CustomerGroup;

    public function updateCustomerGroup(array $data): bool;

    public function findCustomerGroupById(int $id): CustomerGroup;

    public function listCustomerGroups($totalView): Collection;

    public function deleteCustomerGroup(): bool;

    public function searchCustomerGroup(string $text = null): Collection;

    public function getAllCustomerGroupNames();
}
