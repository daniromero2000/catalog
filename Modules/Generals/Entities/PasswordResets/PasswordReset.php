<?php

namespace Modules\Generals\Entities\PasswordResets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordReset extends Model
{
    use SoftDeletes;

    protected $table = 'password_resets';
    protected $fillable = ['email', 'token'];
    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden = [];
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
