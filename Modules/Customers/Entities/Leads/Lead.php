<?php

namespace Modules\Customers\Entities\Leads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\LeadCommentaries\LeadCommentary;
use Modules\Customers\Entities\LeadReasons\LeadReason;
use Modules\Customers\Entities\LeadStatuses\LeadStatus;
use Modules\Customers\Entities\LeadStatusesLogs\LeadStatusesLog;
use Modules\Customers\Entities\Services\Service;
use Modules\Generals\Entities\Cities\City;
use Nicolaslopezj\Searchable\SearchableTrait;

class Lead extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $table = 'leads';

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'email',
        'phone',
        'data_politics',
        'city_id',
        'lead_reason_id',
        'customer_channel_id',
        'lead_status_id',
        'customer_id',
        'service_id',
        'subsidiary_id'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'relevance'
    ];

    protected $searchable = [
        'columns' => [
            'leads.name'      => 12,
            'leads.last_name' => 12,
            'leads.email'     => 12,
            'leads.phone'     => 12,
            'cities.city'     => 12,
        ],
        'joins' => [
            'cities' => ['cities.id', 'leads.city_id']
        ]
    ];

    public function searchLead($term)
    {
        return self::search($term, null, true, true);
    }

    public function leadChannel(): BelongsTo
    {
        return $this->belongsTo(CustomerChannel::class, 'customer_channel_id')
            ->select(['id', 'channel', 'is_active', 'created_at']);
    }

    public function leadStatus(): BelongsTo
    {
        return $this->belongsTo(LeadStatus::class)
            ->select(['id', 'name', 'color', 'is_active', 'created_at']);
    }

    public function leadReason(): BelongsTo
    {
        return $this->belongsTo(LeadReason::class)
            ->select(['id', 'reason', 'created_at']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function commentaries(): HasMany
    {
        return $this->hasMany(LeadCommentary::class)
            ->select(['id', 'commentary', 'lead_id', 'user', 'created_at']);
    }

    public function leadStatusesLogs(): HasMany
    {
        return $this->hasMany(LeadStatusesLog::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'lead_id', 'status', 'user', 'time_passed', 'created_at']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'city', 'province_id', 'is_active', 'created_at']);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)
            ->select(['id', 'service', 'is_active', 'created_at']);
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class)
            ->select(['name', 'address', 'phone']);
    }
}
