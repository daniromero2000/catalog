<?php

namespace Modules\Companies\Entities\EmployeeCommentaries;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeCommentary extends Model
{
    protected $table = 'employee_commentaries';

    public $fillable = [
        'employee_id',
        'commentary',
        'user'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance',
        'id',
        'status',
        'employee_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'status',
        'user'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(
                ['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']
            );
    }
}
