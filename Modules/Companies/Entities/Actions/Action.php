<?php

namespace Modules\Companies\Entities\Actions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\ActionFactory;
use Modules\Companies\Entities\Permissions\Permission;
use Nicolaslopezj\Searchable\SearchableTrait;

class Action extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'actions';

    protected $fillable = [
        'permission_id',
        'name',
        'icon',
        'route',
        'principal',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
        'status',
        'relevance'
    ];

    protected $guarded = [
        'created_at',
        'deleted_at',
        'updated_at',
        'is_active',
        'status'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'actions.name' => 10,
            'actions.route' => 10
        ]
    ];

    protected static function newFactory()
    {
        return ActionFactory::new();
    }

    public function searchAction($term)
    {
        return self::search($term, null, true, true);
    }

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'action_role', 'action_id', 'role_id')
            ->select(['action_id', 'role_id', 'status']);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class)
            ->select(['id', 'name', 'display_name', 'status']);
    }
}
