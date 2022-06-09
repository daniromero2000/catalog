<?php

namespace Modules\Generals\Entities\Stratums\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Stratums\Stratum;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;

class StratumRepository implements StratumRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'stratum', 'description'];

    public function __construct(Stratum $Stratum)
    {
        $this->model = $Stratum;
    }

    public function getAllStratumsNames(): Collection
    {
        return $this->model->orderBy('stratum', 'asc')
            ->get($this->columns);
    }
}
