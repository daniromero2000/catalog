<?php

namespace Modules\Generals\Entities\Housings\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;

class HousingRepository implements HousingRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'housing'];

    public function __construct(Housing $housing)
    {
        $this->model = $housing;
    }

    public function getAllHousingsNames(): Collection
    {
        return $this->model->orderBy('housing', 'asc')->get($this->columns);
    }
}
