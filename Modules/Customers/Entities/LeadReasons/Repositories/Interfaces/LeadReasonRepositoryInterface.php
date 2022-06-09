<?php

namespace Modules\Customers\Entities\LeadReasons\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\LeadReasons\LeadReason;

interface LeadReasonRepositoryInterface
{
    public function createLeadReason(array $data): LeadReason;

    public function updateLeadReason(array $data): bool;

    public function findLeadReasonById(int $id): LeadReason;

    public function listLeadReasons($totalView): Collection;

    public function deleteLeadReason(): bool;

    public function searchLeadReason(string $text = null): Collection;

    public function getAllLeadReasonsNames(): Collection;
}
