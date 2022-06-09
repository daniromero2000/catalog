<?php

namespace Modules\Generals\Entities\Cities\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Cities\City;

interface CityRepositoryInterface
{
    public function getAllCityNames(): Collection;

    public function listCities(int $provinceId, int $totalView): Collection;

    public function findCityById(int $id): City;

    public function findCityByName(string $name): City;

    public function findCityByProvince(int $id): Collection;

    public function countCities(int $provinceId);
}
