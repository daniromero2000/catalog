<?php

namespace Modules\XisfoPay\Entities\ContractRequestCommentaries;

use Illuminate\Database\Eloquent\Model;

class ContractRequestCommentary extends Model
{
    protected $table = 'contract_request_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'contract_request_id'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];
}
