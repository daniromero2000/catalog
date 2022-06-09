<?php

namespace Modules\XisfoPay\Entities\XisfoPayParameters\UseCases\Interfaces;

interface XisfoPayParameterUseCaseInterface
{
    public function set4x1000($value);

    public function getValueIva($value);

    public function getValueRetention($value);

    public function getAdvanceValuePercentage($value);

    public function getEnsuranceValuePercentage($value);
}
