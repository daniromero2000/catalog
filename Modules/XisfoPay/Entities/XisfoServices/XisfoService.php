<?php

namespace Modules\XisfoPay\Entities\XisfoServices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;
use Modules\XisfoPay\Database\factories\XisfoServiceFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class XisfoService extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'xisfo_services';

    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'xisfo_services.id'  => 10,
            'xisfo_services.name'  => 10,
        ]
    ];

    public function searchXisfoService($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return XisfoServiceFactory::new();
    }

    public function Employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_xisfo_service', 'xisfo_service_id', 'employee_id');
    }
}
