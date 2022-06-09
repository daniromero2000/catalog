<?php

namespace Modules\Customers\Entities\LeadReasons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Customers\Database\factories\LeadReasonFactory;
use Modules\Customers\Entities\Leads\Lead;
use Nicolaslopezj\Searchable\SearchableTrait;

class LeadReason extends Model
{
    use SearchableTrait, HasFactory;

    protected $table = 'lead_reasons';

    protected $fillable = [
        'reason',
        'company_id'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    protected $searchable = [
        'columns' => [
            'lead_reasons.reason'      => 10,
        ]
    ];

    public function searchLeadStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return LeadReasonFactory::new();
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class)
            ->select([
                'id', 'name', 'last_name', 'email', 'phone', 'data_politics', 'city_id',
                'customer_channel_id', 'lead_status_id', 'lead_reason_id', 'customer_id', 'created_at'
            ]);
    }
}
