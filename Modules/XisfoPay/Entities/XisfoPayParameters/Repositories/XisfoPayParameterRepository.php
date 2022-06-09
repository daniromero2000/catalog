<?php

namespace Modules\XisfoPay\Entities\XisfoPayParameters\Repositories;

use Modules\XisfoPay\Entities\XisfoPayParameters\Repositories\Interfaces\XisfoPayParameterRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\XisfoPayParameter;

class XisfoPayParameterRepository implements XisfoPayParameterRepositoryInterface
{
    protected $model;

    public function __construct(
        XisfoPayParameter $xisfoPayParameter
    ) {
        $this->model = $xisfoPayParameter;
    }

    public function getcuatroXmil()
    {
        return $this->model->getcuatroXmil();
    }

    public function getretentionPercentage()
    {
        return $this->model->getretentionPercentage();
    }

    public function getgainEnsurance()
    {
        return $this->model->getgainEnsurance();
    }

    public function getIva()
    {
        return $this->model->getIva();
    }

    public function getAdvancePercentage()
    {
        return $this->model->getAdvancePercentage();
    }
}
