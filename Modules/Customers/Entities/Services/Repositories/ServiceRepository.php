<?php

namespace Modules\Customers\Entities\Services\Repositories;

use Modules\Customers\Entities\Services\Service;
use Modules\Customers\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(
        Service $service
    ) {
        $this->model = $service;
    }

    public function getAllServicesNames()
    {
        return $this->model->get(['id', 'service']);
    }
}
