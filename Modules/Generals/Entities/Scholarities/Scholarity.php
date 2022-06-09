<?php

namespace Modules\Generals\Entities\Scholarities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Generals\Database\factories\ScholarityFactory;

class Scholarity extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'scholarities';
    protected $fillable = ['scholarity'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ScholarityFactory::new();
    }

    public function customers(): HasMany
    {
        return  $this->hasMany(Customer::class);
    }
}
