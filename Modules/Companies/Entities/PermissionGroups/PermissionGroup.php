<?php

namespace Modules\Companies\Entities\PermissionGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\PermissionGroupFactory;
use Modules\Companies\Entities\Permissions\Permission;

class PermissionGroup extends Model
{
    use SoftDeletes, HasFactory;
    protected $table   = 'permission_groups';
    public $fillable   = ['name'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return PermissionGroupFactory::new();
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class)
            ->select(['id', 'name', 'display_name', 'icon', 'description', 'status']);
    }
}
