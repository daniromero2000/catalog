<?php

namespace Modules\Companies\Entities\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\LaratrustRole;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Companies\Database\factories\RoleFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends LaratrustRole
{
    use Notifiable, SoftDeletes, SearchableTrait, HasFactory;
    protected $table    = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];
    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'roles.name'         => 10,
            'roles.display_name' => 10,
        ]
    ];

    protected static function newFactory()
    {
        return RoleFactory::new();
    }

    public function searchRole($term)
    {
        return self::search($term, null, true, true);
    }

    public function permission(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id')
            ->orderBy('name', 'asc');
    }

    public function action(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'action_role', 'role_id', 'action_id')
            ->orderBy('name', 'asc')
            ->select(['id', 'permission_id', 'name', 'icon', 'route', 'principal']);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'role_user', 'role_id', 'user_id');
    }
}
