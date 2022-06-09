<?php

namespace Modules\Companies\Entities\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\LaratrustPermission;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\PermissionFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Permission extends LaratrustPermission
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'display_name',
        'icon',
        'description',
        'permission_group_id'
    ];

    protected $hidden  = ['relevance', 'created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'permissions.name'         => 10,
            'permissions.display_name' => 10,
        ]
    ];

    protected static function newFactory()
    {
        return PermissionFactory::new();
    }

    public function searchPermission($term)
    {
        return self::search($term, null, true, true);
    }

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id')
            ->select(['id', 'name', 'display_name',]);
    }

    public function permissionGroup(): BelongsTo
    {
        return $this->belongsTo(PermissionGroup::class)
            ->select(['id', 'name', 'group_order', 'status']);
    }
}
