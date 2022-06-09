<?php

namespace Modules\XisfoPay\Entities\XisfoPayParameters\UseCases;

use Modules\XisfoPay\Entities\XisfoPayParameters\Repositories\Interfaces\XisfoPayParameterRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\UseCases\Interfaces\XisfoPayParameterUseCaseInterface;

class XisfoPayParameterUseCase implements XisfoPayParameterUseCaseInterface
{
    private $xisfoPayParametersInterface;

    public function __construct(
        XisfoPayParameterRepositoryInterface $xisfoPayParameterRepositoryInterface
    ) {
        $this->xisfoPayParametersInterface = $xisfoPayParameterRepositoryInterface;
    }

    public function set4x1000($value)
    {
        return round($value * $this->xisfoPayParametersInterface->getcuatroXmil(), 2);
    }

    public function getValueIva($value)
    {
        return round($value * $this->xisfoPayParametersInterface->getIva(), 2);
    }

    public function getValueRetention($value)
    {
        return round($value * $this->xisfoPayParametersInterface->getretentionPercentage(), 2);
    }

    public function getAdvanceValuePercentage($value)
    {
        return floor($value * $this->xisfoPayParametersInterface->getAdvancePercentage());
    }

    public function getEnsuranceValuePercentage($value)
    {
        return ($value * $this->xisfoPayParametersInterface->getgainEnsurance());
    }
}
