<?php

namespace Modules\Companies\Entities\ActionRole;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Database\factories\ActionRoleFactory;

class ActionRole extends Model
{
    use HasFactory;
    protected $table    = 'action_role';
    public $timestamps  = false;
    protected $fillable = ['action_id', 'role_id'];
    protected $guarded  = ['id'];

    protected static function newFactory()
    {
        return ActionRoleFactory::new();
    }
}
