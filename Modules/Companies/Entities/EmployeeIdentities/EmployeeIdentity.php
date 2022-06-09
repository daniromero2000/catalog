<?php

namespace Modules\Companies\Entities\EmployeeIdentities;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\IdentityTypes\IdentityType;

class EmployeeIdentity extends Model
{
    use SoftDeletes;
    protected $table = 'employee_identities';
    public $fillable = [
        'identity_type_id',
        'identity_number',
        'expedition_date',
        'city_id',
        'employee_id'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'Employee_id',
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }

    public function identityType(): BelongsTo
    {
        return $this->belongsTo(IdentityType::class)->select(['id', 'identity_type']);
    }
}
