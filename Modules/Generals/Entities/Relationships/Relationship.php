<?php

namespace Modules\Generals\Entities\Relationships;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;
use Modules\Generals\Database\factories\RelationshipFactory;
use Modules\Generals\Entities\ReferenceTypes\ReferenceType;

class Relationship extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'relationships';
    protected $fillable = ['relationship'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return RelationshipFactory::new();
    }

    public function customerReferences(): HasMany
    {
        return $this->hasMany(CustomerReference::class);
    }

    public function referenceType(): BelongsTo
    {
        return $this->belongsTo(ReferenceType::class)
            ->select(['id', 'reference_type']);
    }
}
