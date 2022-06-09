<?php

namespace Modules\Banking\Entities\Trms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Trm extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;

    protected $table = '';

    protected $fillable = [];

    protected $dates  = [];

    protected $guarded = [];

    protected $searchable = [];

    public function searchTrm($term)
    {
        return self::search($term, null, true, true);
    }
}
