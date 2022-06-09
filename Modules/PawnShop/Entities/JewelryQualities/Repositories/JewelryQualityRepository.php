<?php

namespace Modules\PawnShop\Entities\JewelryQualities\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\PawnShop\Entities\JewelryQualities\JewelryQuality;
use Modules\PawnShop\Entities\JewelryQualities\Exceptions\JewelryQualityNotFoundException;
use Modules\PawnShop\Entities\JewelryQualities\Exceptions\CreateJewelryQualityErrorException;
use Modules\PawnShop\Entities\JewelryQualities\Exceptions\DeletingJewelryQualityErrorException;
use Modules\PawnShop\Entities\JewelryQualities\Exceptions\UpdateJewelryQualityErrorException;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces\JewelryQualityRepositoryInterface;

class JewelryQualityRepository implements JewelryQualityRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'price',
        'created_at'
    ];

    public function __construct(JewelryQuality $jewelryQuality)
    {
        $this->model = $jewelryQuality;
    }

    public function createJewelryQuality(array $data): JewelryQuality
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateJewelryQualityErrorException($e->getMessage());
        }
    }

    public function updateJewelryQuality(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateJewelryQualityErrorException($e->getMessage());
        }
    }

    public function findJewelryQualityById(int $id): JewelryQuality
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new JewelryQualityNotFoundException($e->getMessage());
        }
    }

    public function deleteJewelryQuality(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingJewelryQualityErrorException($e->getMessage());
        }
    }

    public function searchJewelryQuality(string $text = null)
    {
        if (is_null($text)) {
            return $this->listJewelryQualities();
        } else {
            return $this->model->searchJewelryQuality($text)
                ->select($this->columns)
                ->orderBy('name', 'desc')
                ->paginate(10);
        }
    }

    private function listJewelryQualities()
    {
        return  $this->model
            ->select($this->columns)
            ->orderBy('name', 'asc')
            ->paginate(10);
    }

    public function getAllJewelryQualityNames()
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
