<?php

namespace Modules\Customers\Entities\Leads\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Customers\Entities\Leads\Lead;

interface LeadRepositoryInterface
{
    public function createlead($data): Lead;

    public function listLeads();

    public function findLeadById(int $id): Lead;

    public function updateLead(array $data): bool;

    public function deleteLead(): bool;

    public function searchLead(string $text = null, $from = null, $to = null);

    public function searchSubsidiaryLead(string $text = null, int $subsidiary_id, $from = null, $to = null);

    public function countLead(string $text = null,  $from = null, $to = null);
}
