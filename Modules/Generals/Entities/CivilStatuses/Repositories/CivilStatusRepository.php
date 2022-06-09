<?php

namespace Modules\Generals\Entities\CivilStatuses\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces\CivilStatusRepositoryInterface;

class CivilStatusRepository implements CivilStatusRepositoryInterface
{
    protected $model;

    public function __construct(CivilStatus $CivilStatus)
    {
        $this->model = $CivilStatus;
    }

    public function getAllCivilStatusesNames(): Collection
    {
        return $this->model->orderBy('civil_status', 'asc')
            ->get(['id', 'civil_status']);
    }
}
