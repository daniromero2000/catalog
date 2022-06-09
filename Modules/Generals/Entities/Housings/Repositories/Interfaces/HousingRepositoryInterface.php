<?php

namespace Modules\Generals\Entities\Housings\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface HousingRepositoryInterface
{
    public function getAllHousingsNames(): Collection;
}
