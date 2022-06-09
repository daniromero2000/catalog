<?php

namespace Modules\Generals\Entities\ReferenceTypes\Repositories;

use Modules\Generals\Entities\ReferenceTypes\ReferenceType;
use Modules\Generals\Entities\ReferenceTypes\Repositories\Interfaces\ReferenceTypeRepositoryInterface;

class ReferenceTypeRepository implements ReferenceTypeRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(ReferenceType $ReferenceType)
    {
        $this->model = $ReferenceType;
    }
}
