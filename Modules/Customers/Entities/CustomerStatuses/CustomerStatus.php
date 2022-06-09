<?php

namespace Modules\Customers\Entities\CustomerStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\Entities\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\factories\CustomerStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerStatus extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'customer_statuses';

    protected $fillable = [
        'status',
        'color'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'customer_statuses.name' => 10
        ]
    ];

    protected static function newFactory()
    {
        return CustomerStatusFactory::new();
    }

    public function searchCustomerStatuses($term)
    {
        return self::search($term, null, true, true);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
