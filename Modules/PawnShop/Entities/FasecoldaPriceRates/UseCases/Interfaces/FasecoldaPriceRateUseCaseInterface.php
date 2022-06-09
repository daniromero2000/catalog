<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases\Interfaces;

interface FasecoldaPriceRateUseCaseInterface
{
    public function listFasecoldaPriceRates(array $data): array;

    public function createFasecoldaPriceRate();

    public function storeFasecoldaPriceRate(array $requestData);

    public function updateFasecoldaPriceRate($request, int $id);

    public function destroyFasecoldaPriceRate(int $id);
}
