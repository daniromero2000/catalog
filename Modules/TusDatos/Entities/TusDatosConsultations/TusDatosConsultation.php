<?php

namespace Modules\TusDatos\Entities\TusDatosConsultations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class TusDatosConsultation extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'tus_datos_consultations';

    protected $fillable = [
        'email', 'identiy_number', 'jobid', 'name', 'typedoc', 'validado'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'tus_datos_consultations.name'           => 10,
            'tus_datos_consultations.identiy_number' => 10,
        ]
    ];

    public function searchTusDatosConsultation($term)
    {
        return self::search($term, null, true, true);
    }
}
