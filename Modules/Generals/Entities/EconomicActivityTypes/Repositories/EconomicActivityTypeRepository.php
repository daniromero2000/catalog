<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;
use Modules\Generals\Entities\EconomicActivityTypes\Repositories\Interfaces\EconomicActivityTypeRepositoryInterface;


class EconomicActivityTypeRepository implements EconomicActivityTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'economic_activity_type'];

    public function __construct(EconomicActivityType $EconomicActivityType)
    {
        $this->model = $EconomicActivityType;
    }

    public function getAllEconomicActivityTypesNames(): Collection
    {
        return $this->model->orderBy('economic_activity_type', 'asc')
            ->get($this->columns);
    }
}
