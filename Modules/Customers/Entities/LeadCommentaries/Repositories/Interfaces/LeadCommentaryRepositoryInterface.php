<?php

namespace Modules\Customers\Entities\LeadCommentaries\Repositories\Interfaces;

use Modules\Customers\Entities\LeadCommentaries\LeadCommentary;

interface LeadCommentaryRepositoryInterface
{
    public function createLeadCommentary(array $data): LeadCommentary;
}
