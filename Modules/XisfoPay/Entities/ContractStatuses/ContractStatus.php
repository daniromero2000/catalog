<?php

namespace Modules\XisfoPay\Entities\ContractStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Database\factories\ContractStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractStatus extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'contract_statuses';

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
            'contract_statuses.name'  => 10,
            'contract_statuses.id'  => 10,
        ]
    ];

    public function searchContractStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return ContractStatusFactory::new();
    }
}
