<?php

namespace Modules\Customers\Entities\LeadCommentaries\Repositories;

use Illuminate\Database\QueryException;
use Modules\Customers\Entities\LeadCommentaries\Exceptions\CreateLeadCommentaryErrorException;
use Modules\Customers\Entities\LeadCommentaries\LeadCommentary;
use Modules\Customers\Entities\LeadCommentaries\Repositories\Interfaces\LeadCommentaryRepositoryInterface;

class LeadCommentaryRepository implements LeadCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(LeadCommentary $leadCommentary)
    {
        $this->model = $leadCommentary;
    }

    public function createLeadCommentary(array $data): LeadCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateLeadCommentaryErrorException($e->getMessage());
        }
    }
}
