<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Fasecolda\Entities\FasecoldaPrices\FasecoldaPrice;
use Nicolaslopezj\Searchable\SearchableTrait;

class FasecoldaCode extends Model
{
    use SearchableTrait;
    protected $table = 'fasecolda_codes';

    protected $fillable = [
        'Novedad',
        'Marca',
        'Clase',
        'Codigo',
        'Homologocodigo',
        'Referencia1',
        'Referencia2',
        'Referencia3',
        'Peso',
        'IdServicio',
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
        'PesoCategoria'
    ];

    protected $dates   = [
        'created_at',
        'updated_at'
    ];

    protected $hidden  = [];

    protected $guarded = [
        'id',
        'deleted_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'fasecolda_codes.Codigo'  => 10,
        ]
    ];

    public function searchFasecoldaCode($term)
    {
        return self::search($term, null, true, true);
    }

    public function fasecoldaPrices(): HasMany
    {
        return $this->hasMany(FasecoldaPrice::class, 'Codigo', 'Codigo');
    }
}
