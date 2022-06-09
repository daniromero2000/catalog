<?php

namespace Modules\Generals\Entities\Scholarities\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Scholarities\Scholarity;
use Modules\Generals\Entities\Scholarities\Repositories\Interfaces\ScholarityRepositoryInterface;

class ScholarityRepository implements ScholarityRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'scholarity'];

    public function __construct(Scholarity $Scholarity)
    {
        $this->model = $Scholarity;
    }

    public function getAllScholaritiesNames(): Collection
    {
        return $this->model->orderBy('scholarity', 'asc')
            ->get($this->columns);
    }
}
