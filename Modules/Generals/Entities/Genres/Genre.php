<?php

namespace Modules\Generals\Entities\Genres;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Generals\Database\factories\GenreFactory;

class Genre extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'genres';
    protected $fillable = ['genre'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return GenreFactory::new();
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
