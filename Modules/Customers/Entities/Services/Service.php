<?php

namespace Modules\Customers\Entities\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\factories\ServiceFactory;

class Service extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'service',
        'is_active'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ServiceFactory::new();
    }
}
