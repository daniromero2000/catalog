<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\PawnShop\Entities\FasecoldaPriceRates\FasecoldaPriceRate;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Exceptions\FasecoldaPriceRateNotFoundException;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Exceptions\CreateFasecoldaPriceRateErrorException;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Exceptions\DeletingFasecoldaPriceRateErrorException;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Exceptions\UpdateFasecoldaPriceRateErrorException;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces\FasecoldaPriceRateRepositoryInterface;

class FasecoldaPriceRateRepository implements FasecoldaPriceRateRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'price',
        'created_at'
    ];

    public function __construct(FasecoldaPriceRate $fasecoldaPriceRate)
    {
        $this->model = $fasecoldaPriceRate;
    }

    public function createFasecoldaPriceRate(array $data): FasecoldaPriceRate
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateFasecoldaPriceRateErrorException($e->getMessage());
        }
    }

    public function updateFasecoldaPriceRate(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateFasecoldaPriceRateErrorException($e->getMessage());
        }
    }

    public function findFasecoldaPriceRateById(int $id): FasecoldaPriceRate
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new FasecoldaPriceRateNotFoundException($e->getMessage());
        }
    }


    public function deleteFasecoldaPriceRate(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingFasecoldaPriceRateErrorException($e->getMessage());
        }
    }

    public function searchFasecoldaPriceRate(string $text = null)
    {
        if (is_null($text)) {
            return $this->listFasecoldaPriceRates();
        } else {
            return $this->model->searchFasecoldaPriceRate($text)
                ->select($this->columns)
                ->orderBy('name', 'desc')
                ->paginate(10);
        }
    }

    private function listFasecoldaPriceRates()
    {
        return  $this->model
            ->select($this->columns)
            ->orderBy('name', 'asc')
            ->paginate(10);
    }

    public function getAllFasecoldaPriceRateNames()
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
    }
}
