<?php

namespace Modules\Generals\Entities\ProfessionsGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\ProfessionsGroupFactory;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class ProfessionsGroup extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'professions_groups';
    protected $fillable = ['ciuo', 'professions_group'];
    protected $hidden   = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ProfessionsGroupFactory::new();
    }

    public function professionsLists(): HasMany
    {
        return $this->hasMany(ProfessionsList::class);
    }
}
