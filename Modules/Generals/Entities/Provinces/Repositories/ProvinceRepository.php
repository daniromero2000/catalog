<?php

namespace Modules\Generals\Entities\Provinces\Repositories;

use Modules\Generals\Entities\Countries\Country;
use Modules\Generals\Entities\Provinces\Province;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Provinces\Exceptions\ProvinceNotFoundException;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'dane', 'province', 'country_id', 'is_active'];

    public function __construct(Province $province)
    {
        $this->model = $province;
    }

    public function listProvinces(int $totalView): Collection
    {
        return $this->model->skip($totalView)->take(10)->get($this->columns);
    }

    public function findProvinceById(int $id): Province
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ProvinceNotFoundException($e->getMessage());
        }
    }

    public function findCountry(): Country
    {
        return $this->model->country;
    }

    public function countProvinces(int $countryId)
    {
        return count($this->model->where('country_id', $countryId)
            ->get($this->columns));
    }

    public function getAllProvincesPrefixes(): Collection
    {
        return $this->model->where('country_id', 1)
            ->get(['province', 'prefix', 'id']);
    }

    public function getAllProvincesNames(): Collection
    {
        return $this->model->where('country_id', 1)
            ->get(['province', 'id']);
    }
}
