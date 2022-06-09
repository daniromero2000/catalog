<?php

namespace Modules\Customers\Entities\CustomerProfessions;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class CustomerProfession extends Model
{
    use SoftDeletes;
    protected $table = 'customer_professions';

    public $fillable = [
        'customer_id',
        'professions_list_id'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'professions_list_id',
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

    public function professionsList(): BelongsTo
    {
        return $this->belongsTo(ProfessionsList::class)
            ->select(['id', 'ciuo', 'profession']);
    }
}
