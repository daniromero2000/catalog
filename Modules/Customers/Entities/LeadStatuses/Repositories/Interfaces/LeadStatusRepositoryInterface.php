<?php

namespace Modules\Customers\Entities\LeadStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\LeadStatuses\LeadStatus;

interface LeadStatusRepositoryInterface
{
    public function createLeadStatus(array $data): LeadStatus;

    public function updateLeadStatus(array $data): bool;

    public function findLeadStatusById(int $id): LeadStatus;

    public function listLeadStatuses($totalView): Collection;

    public function deleteLeadStatus(): bool;

    public function searchLeadStatus(string $text = null): Collection;

    public function getAllLeadStatusesNames(): Collection;
}
