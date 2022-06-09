<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces;

use Modules\PawnShop\Entities\FasecoldaPriceRates\FasecoldaPriceRate;

interface FasecoldaPriceRateRepositoryInterface
{
    public function createFasecoldaPriceRate(array $data): FasecoldaPriceRate;

    public function updateFasecoldaPriceRate(array $data): bool;

    public function findFasecoldaPriceRateById(int $id): FasecoldaPriceRate;

    public function deleteFasecoldaPriceRate(): bool;

    public function searchFasecoldaPriceRate(string $text = null);

    public function getAllFasecoldaPriceRateNames();
}
