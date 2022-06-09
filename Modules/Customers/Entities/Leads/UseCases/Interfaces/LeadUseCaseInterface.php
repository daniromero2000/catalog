<?php

namespace Modules\Customers\Entities\Leads\UseCases\Interfaces;

interface LeadUseCaseInterface
{

    public function listLeads(array $data): array;

    public function createLead();

    public function createLeadFront();

    public function storeLeadFront($request);

    public function showLead(int $id): array;

    public function updateLead(array $requestData, $id);
}
