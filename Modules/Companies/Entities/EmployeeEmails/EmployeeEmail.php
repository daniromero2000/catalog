<?php

namespace Modules\Companies\Entities\EmployeeEmails;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeEmail extends Model
{
    use SoftDeletes;
    protected $table = 'employee_emails';

    public $fillable = [
        'employee_id',
        'email',
        'email_type'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'employee_id',
        'status',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(
                ['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']
            );
    }
}
