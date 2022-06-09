<?php

namespace Modules\Banking\Entities\Trms\Repositories;

use Modules\Banking\Entities\Trms\Trm;
use Modules\Banking\Entities\Trms\Repositories\Interfaces\TrmRepositoryInterface;

class TrmRepository implements TrmRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(Trm $trm)
    {
        $this->model = $trm;
    }
}
