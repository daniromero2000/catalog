<?php

namespace Modules\CamStudio\Entities\CammodelCategories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Database\factories\CammodelCategoryFactory;

class CammodelCategory extends Model
{
    use NodeTrait, SoftDeletes, HasFactory;
    protected $table = 'cammodel_categories';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'sort_order',
        'parent_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'cammodel_categories.name' => 10,
            'cammodel_categories.slug' => 5
        ]
    ];

    protected static function newFactory()
    {
        return CammodelCategoryFactory::new();
    }

    public function searchCammodelCategories(string $term): Collection
    {
        return self::search($term, null, true, true)->get();
    }

    public function cammodel(): BelongsToMany
    {
        return $this->belongsToMany(Cammodel::class)->orderBy('sort_order', 'asc');
    }
}
