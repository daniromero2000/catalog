<?php

namespace Modules\Generals\Entities\PopUps;

use Illuminate\Database\Eloquent\Model;

class PopUp extends Model
{
    protected $fillable = ['name', 'images', 'condition'];
}
