<?php

namespace Modules\Generals\Entities\EconomicActivityTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;
use Modules\Generals\Database\factories\EconomicActivityTypeFactory;

class EconomicActivityType extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'economic_activity_types';
    protected $fillable = ['economic_activity_type'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $hidden   = ['deleted_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return EconomicActivityTypeFactory::new();
    }

    public function customerEconomicActivities(): HasMany
    {
        return $this->hasMany(CustomerEconomicActivity::class)
            ->select(['economicActivityType', 'professionsList', 'city']);
    }
}
