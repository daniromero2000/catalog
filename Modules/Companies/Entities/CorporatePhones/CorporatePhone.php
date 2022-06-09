<?php

namespace Modules\Companies\Entities\CorporatePhones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\CorporatePhoneFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class CorporatePhone extends Model
{
    use SearchableTrait, SoftDeletes, HasFactory;
    protected $table = 'corporate_phones';

    protected $fillable = [
        'simcard_number',
        'operator',
        'phone',
        'description',
        'deleted_at'
    ];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        return CorporatePhoneFactory::new();
    }

}
