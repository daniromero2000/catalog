<?php

namespace Modules\Generals\Entities\ReferenceTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Generals\Entities\Relationships\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\ReferenceTypeFactory;

class ReferenceType extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'reference_types';
    protected $fillable = ['reference_type'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ReferenceTypeFactory::new();
    }

    public function relationships(): HasMany
    {
        return $this->hasMany(Relationship::class)
            ->select(['id', 'relationship', 'reference_type_id']);
    }
}
