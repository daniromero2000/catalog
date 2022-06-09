<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\Repositories;


use Modules\Fasecolda\Entities\FasecoldaCodes\FasecoldaCode;
use Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\Interfaces\FasecoldaCodeRepositoryInterface;

class FasecoldaCodeRepository implements FasecoldaCodeRepositoryInterface
{
    private $columns = [
        'Marca',
        'Clase',
        'Codigo',
        'Referencia1',
        'Referencia2',
        'Referencia3',
        'Servicio',
        'Bcpp',
        'Importado',
        'Potencia',
        'TipoCaja',
        'Cilindraje',
        'Nacionalidad',
        'CapacidadPasajeros',
        'CapacidadCarga',
        'Puertas',
        'AireAcondicionado',
        'Ejes',
        'Estado',
        'Combustible',
        'Transmision',
        'Um',
        'PesoCategoria',
        'created_at'
    ];

    public function __construct(FasecoldaCode $fasecoldacode)
    {
        $this->model = $fasecoldacode;
    }

    public function truncateTable()
    {
        return $this->model->truncate();
    }

    public function searchFasecoldaCode(string $text = null, $fasecoldaCode = null)
    {
        if (is_null($text)) {
            return null;
        } else {
            return $this->model->searchFasecoldaCode($text)
                ->with('fasecoldaPrices')
                ->where('Codigo', $text)->first($this->columns);
        }
    }

    public function listFasecoldaBrands($clase)
    {
        return $this->model->select('Marca')
            ->where('Clase', $clase)
            ->groupBy('Marca')
            ->orderBy('Marca', 'asc')
            ->get()
            ->toArray();
    }

    public function listFasecoldaRefs1($marca, $clase)
    {
        return $this->model->select('Referencia1')
            ->where('Marca', $marca)
            ->where('Clase', $clase)
            ->groupBy('Referencia1')
            ->orderBy('Referencia1', 'asc')
            ->get()
            ->toArray();
    }

    public function listFasecoldaRefs2($marca, $clase, $ref1)
    {
        return $this->model->select('Referencia2')
            ->where('Referencia1', $ref1)
            ->where('Marca', $marca)
            ->where('Clase', $clase)
            ->groupBy('Referencia2')
            ->orderBy('Referencia2', 'asc')
            ->get()
            ->toArray();
    }

    public function listFasecoldaRefs3($marca, $clase, $ref1, $ref2)
    {
        return $this->model->select('Referencia3')
            ->where('Referencia1', $ref1)
            ->where('Marca', $marca)
            ->where('Clase', $clase)
            ->where('Referencia2', $ref2)
            ->groupBy('Referencia3')
            ->orderBy('Referencia3', 'asc')
            ->get()
            ->toArray();
    }

    public function listFasecoldaCodigo($ref1, $ref2, $ref3)
    {
        return $this->model->select('Codigo')
            ->where('Referencia1', $ref1)
            ->where('Referencia2', $ref2)
            ->where('Referencia3', $ref3)
            ->groupBy('Codigo')
            ->get()
            ->toArray();
    }

    public function listFasecoldaClases()
    {
        return $this->model->all();
    }
}
