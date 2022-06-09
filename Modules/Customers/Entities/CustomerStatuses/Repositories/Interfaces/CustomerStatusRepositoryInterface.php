<?php

namespace Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;

interface CustomerStatusRepositoryInterface
{
    public function createCustomerStatus(array $customerStatusData);

    public function updateCustomerStatus(array $data): bool;

    public function findCustomerStatusById(int $id): CustomerStatus;

    public function listCustomerStatuses(): Collection;

    public function deleteCustomerStatus(): bool;

    public function searchCustomerStatuses(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCustomerStatuses(string $text = null,  $from = null, $to = null);

    public function listCustomerStatus($totalView): Collection;
}
