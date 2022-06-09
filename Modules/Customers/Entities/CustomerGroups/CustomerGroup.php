<?php

namespace Modules\Customers\Entities\CustomerGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\factories\CustomerGroupFactory;
use Modules\Customers\Entities\Customers\Customer;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerGroup extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;

    protected $table = 'customer_groups';

    protected $fillable = [
        'name',
        'code',
        'is_user_defined'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'customer_groups.id'  => 10,
        ]
    ];

    public function searchCustomerGroup($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return CustomerGroupFactory::new();
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
