<?php

namespace Modules\Generals\Entities\Relationships\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface RelationshipRepositoryInterface
{
    public function getAllRelationshipsNames(): Collection;

    public function getLegalRelationshipsNames(): Collection;
}
