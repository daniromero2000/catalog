<?php

namespace Modules\Generals\Entities\Provinces\Repositories\Interfaces;

use Modules\Generals\Entities\Countries\Country;
use Modules\Generals\Entities\Provinces\Province;
use Illuminate\Support\Collection;

interface ProvinceRepositoryInterface
{
    public function listProvinces(int $totalView): Collection;

    public function findProvinceById(int $id): Province;

    public function findCountry(): Country;

    public function countProvinces(int $countryId);

    public function getAllProvincesPrefixes(): Collection;

    public function getAllProvincesNames(): Collection;
}
