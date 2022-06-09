<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Database\factories\ContractRequestStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRequestStatus extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'contract_request_statuses';

    protected $fillable = [
        'name',
        'color',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'contract_request_statuses.name'  => 10,
            'contract_request_statuses.id'    => 10,
        ]
    ];

    public function searchContractRequestStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return ContractRequestStatusFactory::new();
    }
}
