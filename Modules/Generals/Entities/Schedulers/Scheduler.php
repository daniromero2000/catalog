<?php

namespace Modules\Generals\Entities\Schedulers;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Scheduler extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table    = 'schedulers';
    protected $fillable = ['employee_id', 'date', 'time', 'title'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden   = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function Scheduler($term)
    {
        return self::search($term, null, true, true);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'email', 'is_active']);
    }
}
