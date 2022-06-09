<?php

namespace Modules\Generals\Entities\Epss\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Epss\Eps;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;

class EpsRepository implements EpsRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'eps'];

    public function __construct(Eps $Eps)
    {
        $this->model = $Eps;
    }

    public function getAllEpsNames(): Collection
    {
        return $this->model->orderBy('eps', 'asc')
            ->get($this->columns);
    }
}
