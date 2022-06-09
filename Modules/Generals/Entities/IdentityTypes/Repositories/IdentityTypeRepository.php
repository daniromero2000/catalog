<?php

namespace Modules\Generals\Entities\IdentityTypes\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\IdentityTypes\IdentityType;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;

class IdentityTypeRepository implements IdentityTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'identity_type', 'initials'];

    public function __construct(IdentityType $IdentityType)
    {
        $this->model = $IdentityType;
    }

    public function getAllIdentityTypesNames(): Collection
    {
        return $this->model->orderBy('identity_type', 'asc')->get($this->columns);
    }
}
