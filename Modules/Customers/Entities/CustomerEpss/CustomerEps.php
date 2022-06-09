<?php

namespace Modules\Customers\Entities\CustomerEpss;

use Modules\Generals\Entities\Epss\Eps;
use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomerEps extends Model
{
    use SoftDeletes;
    protected $table = 'customer_epss';

    public $fillable = [
        'eps_id',
        'customer_id',
        'default_eps'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'eps_id',
        'id',
        'customer_id',
        'status',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(Eps::class)->select(['id', 'eps', 'is_active']);
    }
}
