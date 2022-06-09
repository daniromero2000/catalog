<?php

namespace Modules\Banking\Entities\Banks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Banking\Database\factories\BankFactory;
use Modules\Generals\Entities\Countries\Country;
use Nicolaslopezj\Searchable\SearchableTrait;

class Bank extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'banks';

    protected $fillable = [
        'name',
        'country_id',
        'is_active',
        'transfer_rate',
        'draft_rate',
        'bank_processing_commission'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'banks.name' => 10,
        ]
    ];

    protected static function newFactory()
    {
        return BankFactory::new();
    }

    public function searchBank($term)
    {
        return self::search($term, null, true, true);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->select(['id', 'exchange_code']);
    }
}
