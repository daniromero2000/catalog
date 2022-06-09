<?php

namespace Modules\Generals\Entities\Countries\Repositories\Interfaces;

use Modules\Generals\Entities\Countries\Country;
use Illuminate\Support\Collection;

interface CountryRepositoryInterface
{
    public function listCountries(int $totalView): Collection;

    public function getCountriesNames(): Collection;

    public function getAllCountriesNames(): Collection;

    public function findCountryById(int $id): Country;

    public function findProvinces();

    public function searchCountry(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCountry(string $text = null,  $from = null, $to = null);
}
