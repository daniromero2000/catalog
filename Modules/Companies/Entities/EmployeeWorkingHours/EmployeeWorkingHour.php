<?php

namespace Modules\Companies\Entities\EmployeeWorkingHours;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;
use Nicolaslopezj\Searchable\SearchableTrait;

class EmployeeWorkingHour extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'employee_working_hours';

    protected $fillable = [
        'date',
        'start_time',
        'finish_time',
        'employee_id'
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
            'employee_working_hours.id'  => 10,
        ]
    ];

    public function searchEmployeeWorkingHour($term)
    {
        return self::search($term, null, true, true);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
