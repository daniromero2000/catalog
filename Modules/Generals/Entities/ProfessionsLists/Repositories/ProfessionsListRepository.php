<?php

namespace Modules\Generals\Entities\ProfessionsLists\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;

class ProfessionsListRepository implements ProfessionsListRepositoryInterface
{
    protected $model;

    public function __construct(ProfessionsList $ProfessionsList)
    {
        $this->model = $ProfessionsList;
    }

    public function getAllProfessionsNames(): Collection
    {
        return $this->model->orderBy('profession', 'asc')
            ->get(['id', 'profession']);
    }
}
