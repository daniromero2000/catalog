<?php

namespace Modules\Customers\Entities\CustomerChannels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\factories\CustomerChannelFactory;
use Modules\Customers\Entities\Customers\Customer;

class CustomerChannel extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'customer_channels';

    protected $fillable = [
        'channel'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return CustomerChannelFactory::new();
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
