<?php

namespace Modules\XisfoPay\Entities\ContractCommentaries;

use Illuminate\Database\Eloquent\Model;

class ContractCommentary extends Model
{
    protected $table = 'contract_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'contract_id'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];
}
