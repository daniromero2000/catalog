<?php

namespace Modules\Companies\Entities\EmployeeEmergencyContacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;

class EmployeeEmergencyContact extends Model
{
    use SoftDeletes;
    protected $table = 'employee_emergency_contacts';

    public $fillable = [
        'name',
        'phone',
        'employee_id',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'Employee_id',
        'status',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select([
                'id', 'name', 'last_name', 'email', 'birthday', 'avatar',
                'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token'
            ]);
    }
}
