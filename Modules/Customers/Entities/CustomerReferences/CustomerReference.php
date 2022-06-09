<?php

namespace Modules\Customers\Entities\CustomerReferences;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Relationships\Relationship;
use Modules\Customers\Entities\Customers\Customer;

class CustomerReference extends Model
{
    use SoftDeletes;
    protected $table = 'customer_references';

    protected $fillable = [
        'customer_id',
        'name',
        'last_name',
        'phone',
        'email',
        'is_active',
        'relationship_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class)->with(['referenceType']);
    }
}
