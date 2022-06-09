<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\Repositories;


use Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\Interfaces\FasecoldaPriceRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\FasecoldaPrice;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FasecoldaPriceRepository implements FasecoldaPriceRepositoryInterface
{
    public function __construct(FasecoldaPrice $fasecoldacode)
    {
        $this->model = $fasecoldacode;
    }

    public function findFasecoldaPriceById(int $id): FasecoldaPrice
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ItemStatusNotFoundException($e->getMessage());
        }
    }

    public function truncateTable()
    {
        return $this->model->truncate();
    }

    public function listFasecoldaYears($fasecoldaCode)
    {
        return FasecoldaPrice::select('Modelo')
            ->where('Codigo', $fasecoldaCode)
            ->groupBy('Modelo')
            ->get()
            ->toArray();
    }

    public function listFasecoldaPrice($Modelo, $fasecoldaCode)
    {
        return FasecoldaPrice::select('Valor')
            ->where('Modelo', $Modelo)
            ->where('Codigo', $fasecoldaCode)
            ->groupBy('Valor')
            ->get()
            ->toArray();
    }
}
