<?php

namespace Modules\Customers\Entities\LeadStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\factories\LeadStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class LeadStatus extends Model
{
    use SearchableTrait, SoftDeletes, HasFactory;

    protected $table = 'lead_statuses';

    protected $fillable = [
        'name',
        'color',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'lead_statuses.name' => 10,
        ]
    ];

    public function searchLeadStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return LeadStatusFactory::new();
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class)
            ->select([
                'id', 'name', 'last_name', 'email', 'phone', 'data_politics', 'city_id',
                'customer_channel_id', 'lead_status_id', 'customer_id', 'created_at'
            ]);
    }
}
