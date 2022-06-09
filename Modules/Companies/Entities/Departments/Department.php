<?php

namespace Modules\Companies\Entities\Departments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\DepartmentFactory;
use Modules\Companies\Entities\Companies\Company;

class Department extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'phone'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
        'city_id',
        'city',
        'employees',
        'opening_hours',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)
            ->select(['id', 'name', 'description', 'country_id', 'logo', 'is_active', 'is_active']);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(employee::class)
            ->select(['id', 'department_id', 'employee_id']);
    }
}
