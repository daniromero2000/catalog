<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\Interfaces;

use Modules\Fasecolda\Entities\FasecoldaPrices\FasecoldaPrice;

interface FasecoldaPriceRepositoryInterface
{
    public function listFasecoldaYears($fasecoldaCode);

    public function listFasecoldaPrice($Modelo, $fasecoldaCode);

    public function truncateTable();
}
