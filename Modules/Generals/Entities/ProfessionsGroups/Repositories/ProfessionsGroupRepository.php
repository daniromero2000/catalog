<?php

namespace Modules\Generals\Entities\ProfessionsGroups\Repositories;

use Modules\Generals\Entities\ProfessionsGroups\ProfessionsGroup;
use Modules\Generals\Entities\ProfessionsGroups\Repositories\Interfaces\ProfessionsGroupRepositoryInterface;

class ProfessionsGroupRepository implements ProfessionsGroupRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(ProfessionsGroup $ProfessionsGroup)
    {
        $this->model = $ProfessionsGroup;
    }
}
