<?php

namespace Modules\Generals\Entities\ProfessionsLists;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerProfessions\CustomerProfession;
use Modules\Generals\Entities\ProfessionsGroups\ProfessionsGroup;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;
use Modules\Generals\Database\factories\ProfessionsListFactory;

class ProfessionsList extends Model
{
    use SoftDeletes, HasFactory;
    protected $table   = 'professions_lists';
    public $fillable   = ['ciuo', 'profession',];
    protected $hidden  = [];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ProfessionsListFactory::new();
    }

    public function professionGroup(): BelongsTo
    {
        return $this->belongsTo(ProfessionsGroup::class)
            ->select(['id', 'ciuo', 'professions_group']);
    }

    public function customerProfessions(): HasMany
    {
        return $this->hasMany(CustomerProfession::class)
            ->select(['id', 'professions_list_id', 'customer_id', 'status', 'created_at']);
    }

    public function customerEconomicActivities(): HasMany
    {
        return $this->hasMany(CustomerEconomicActivity::class)
            ->select(['economicActivityType', 'professionsList', 'city']);
    }
}
