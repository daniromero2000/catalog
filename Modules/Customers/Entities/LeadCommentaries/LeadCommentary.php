<?php

namespace Modules\Customers\Entities\LeadCommentaries;

use Illuminate\Database\Eloquent\Model;

class LeadCommentary extends Model
{
    protected $table = 'lead_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'lead_id'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];
}
