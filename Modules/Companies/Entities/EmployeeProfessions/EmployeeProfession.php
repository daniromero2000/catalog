<?php

namespace Modules\Companies\Entities\EmployeeProfessions;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class EmployeeProfession extends Model
{
    use SoftDeletes;
    protected $table = 'employee_professions';

    public $fillable = [
        'employee_id',
        'professions_list_id'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'professions_list_id',
        'employee_id',
        'status',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']);
    }

    public function professionsList(): BelongsTo
    {
        return $this->belongsTo(ProfessionsList::class)
            ->select(['id', 'ciuo', 'profession']);
    }
}
