<?php

namespace Modules\Generals\Entities\Cities\Repositories;

use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Cities\Exceptions\CityNotFoundException;

class CityRepository implements CityRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'city', 'province_id', 'dane'];

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function getAllCityNames(): Collection
    {
        return $this->model->orderBy('city', 'asc')->get(['id', 'city']);
    }

    public function listCities(int $provinceId, int $totalView): Collection
    {
        return $this->model->where('province_id', $provinceId)
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function findCityById($id): City
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException($e->getMessage());
        }
    }

    public function findCityByProvince(int $id): Collection
    {
        try {
            return $this->model->where('province_id', $id)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException($e->getMessage());
        }
    }

    public function findCityByName(string $name): City
    {
        try {
            return $this->model->where(compact('name'))->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException($e->getMessage());
        }
    }

    public function countCities(int $provinceId)
    {
        return count($this->model->where('province_id', $provinceId)
            ->get($this->columns));
    }
}
