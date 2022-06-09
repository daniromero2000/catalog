<?php

namespace Modules\Generals\Entities\Relationships\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Relationships\Relationship;
use Modules\Generals\Entities\Relationships\Repositories\Interfaces\RelationshipRepositoryInterface;

class RelationshipRepository implements RelationshipRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'relationship'];

    public function __construct(Relationship $relationship)
    {
        $this->model = $relationship;
    }

    public function getAllRelationshipsNames(): Collection
    {
        return $this->model->orderBy('relationship', 'asc')->get($this->columns);
    }

    public function getLegalRelationshipsNames(): Collection
    {
        return $this->model->where('reference_type_id', 3)
            ->get($this->columns);
    }
}
