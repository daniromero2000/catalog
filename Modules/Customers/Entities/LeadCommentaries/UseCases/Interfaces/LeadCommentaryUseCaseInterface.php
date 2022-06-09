<?php

namespace Modules\Customers\Entities\LeadCommentaries\UseCases\Interfaces;

interface LeadCommentaryUseCaseInterface
{
    public function storeLeadCommentary($request);

    public function userLeadCommentary($request);
}
