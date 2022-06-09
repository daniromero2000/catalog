<?php

namespace Modules\Companies\Entities\EmployeePositions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Companies\Database\factories\EmployeePositionFactory;

class EmployeePosition extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'employee_positions';

    protected $fillable = [
        'position'
    ];

    protected $hidden = [];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected static function newFactory()
    {
        return EmployeePositionFactory::new();
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
