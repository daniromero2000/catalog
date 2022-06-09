<?php

namespace Modules\Generals\Entities\CivilStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Generals\Database\factories\CivilStatusFactory;

class CivilStatus extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'civil_statuses';
    protected $fillable = ['civil_status'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return CivilStatusFactory::new();
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
