<?php

namespace Modules\XisfoPay\Entities\XisfoPayParameters\Repositories\Interfaces;


interface XisfoPayParameterRepositoryInterface
{
    public function getcuatroXmil();

    public function getretentionPercentage();

    public function getgainEnsurance();

    public function getIva();

    public function getAdvancePercentage();
}
