<?php

namespace Modules\Companies\Entities\EmployeeAddresses;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Stratums\Stratum;

class EmployeeAddress extends Model
{
    use SoftDeletes;
    protected $table = 'employee_addresses';

    public $fillable = [
        'employee_id',
        'housing_id',
        'time_living',
        'stratum_id',
        'address',
        'city_id',
        'status'
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

    public function housing(): BelongsTo
    {
        return $this->belongsTo(Housing::class)->select(['id', 'housing']);
    }

    public function stratum(): BelongsTo
    {
        return $this->belongsTo(Stratum::class)
            ->select(['id', 'stratum', 'description']);
    }
}
