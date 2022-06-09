<?php

namespace  Modules\Generals\Entities\Epss;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerEpss\CustomerEps;
use Modules\Generals\Database\factories\EpsFactory;

class Eps extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'epss';
    protected $fillable = ['eps'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return EpsFactory::new();
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function customersEpss(): HasMany
    {
        return $this->hasMany(CustomerEps::class)
            ->select(['id', 'eps_id', 'customer_id', 'default_eps', 'created_at']);
    }
}
