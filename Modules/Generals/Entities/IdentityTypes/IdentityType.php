<?php

namespace Modules\Generals\Entities\IdentityTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Generals\Database\factories\IdentityTypeFactory;

class IdentityType extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'identity_types';
    protected $fillable = ['identity_type'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return IdentityTypeFactory::new();
    }

    public function customerIdentities(): HasMany
    {
        return $this->hasMany(CustomerIdentity::class)
            ->select(['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'customer_id', 'status', 'created_at']);
    }
}
