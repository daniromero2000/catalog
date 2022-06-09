<?php

namespace Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;

interface CustomerReferenceRepositoryInterface
{
    public function createCustomerReference(array $data): CustomerReference;

    public function updateCustomerReference(array $data): bool;

    public function findCustomerReferenceById(int $id): CustomerReference;

    public function listCustomerReferences();

    public function deleteCustomerReference(): bool;

    public function searchCustomerReference(string $text = null): Collection;
}
