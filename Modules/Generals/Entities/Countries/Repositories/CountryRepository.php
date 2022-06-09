<?php

namespace Modules\Generals\Entities\Countries\Repositories;

use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Generals\Entities\Countries\Country;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Countries\Exceptions\CountryNotFoundException;

class CountryRepository implements CountryRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'iso', 'iso3', 'numcode', 'phonecode', 'is_active'];

    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function listCountries(int $totalView): Collection
    {
        return $this->model->where('is_active', 1)->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function getCountriesNames(): Collection
    {
        return $this->model->where('is_active', 1)
            ->get($this->columns);
    }

    public function getAllCountriesNames(): Collection
    {
        return $this->model->get($this->columns);
    }

    public function findCountryById(int $id): Country
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CountryNotFoundException($e->getMessage());
        }
    }

    public function findProvinces()
    {
        return $this->model->provinces;
    }

    public function searchCountry(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCountries($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchCountry($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCountry($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countCountry(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchContractRequest($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchContractRequest($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
