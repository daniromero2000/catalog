<?php

namespace Modules\Generals\Entities\Taxes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\TaxFactory;

class Tax extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'taxes';
    protected $fillable = ['name', 'value', 'country_id'];
    protected $hidden   = ['deleted_at', 'updated_at', 'id'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return TaxFactory::new();
    }
}
