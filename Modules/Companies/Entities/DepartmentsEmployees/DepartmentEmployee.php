<?php

namespace Modules\Companies\Entities\DepartmentsEmployees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\DepartmentsEmployeesFactory;

class DepartmentEmployee extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'department_employee';

    protected $fillable = [
        'department_id',
        'employee_id'
    ];

    protected $dates  = [];

    protected $guarded = [
        'id',
        'department_id',
        'employee_id'
    ];

    public $timestamps = false;

    protected static function newFactory()
    {
        return DepartmentsEmployeesFactory::new();
    }

}
