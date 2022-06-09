<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces;

interface FasecoldaPriceUseCaseInterface
{
    public function createFasecoldaPrice(): array;

    public function storeFasecoldaPrice($file);

    public function findFasecoldaPrice($requestData);
}
