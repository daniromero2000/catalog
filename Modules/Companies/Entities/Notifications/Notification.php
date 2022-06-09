<?php

namespace Modules\Companies\Entities\Notifications;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table    = 'notifications';
    protected $fillable = ['data', 'type', 'employee_id'];
    protected $hidden   = ['created_at', 'updated_at'];
    protected $dates    = ['created_at', 'updated_at'];
}
