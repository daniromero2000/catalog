<?php

namespace Modules\Streamings\Entities\Streamings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Modules\Streamings\Database\factories\StreamingFactory;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\ContractRequestStreamAccount;
use Nicolaslopezj\Searchable\SearchableTrait;

class Streaming extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;

    protected $table = 'streamings';

    protected $fillable = [
        'streaming', 'url', 'icon', 'usd_commission', 'usd_token_rate',
        'is_active', 'is_automated'
    ];

    protected $hidden  = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'streamings.streaming' => 10,
            'streamings.url' => 10
        ]
    ];

    public function searchStreaming($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return StreamingFactory::new();
    }

    public function contractRequestStreamAccounts(): HasMany
    {
        return $this->hasMany(ContractRequestStreamAccount::class)
            ->select(['id', 'nickname']);
    }

    public function cammodelStreamAccounts(): HasMany
    {
        return $this->hasMany(CammodelStreamAccount::class)->select(['id']);
    }
}
