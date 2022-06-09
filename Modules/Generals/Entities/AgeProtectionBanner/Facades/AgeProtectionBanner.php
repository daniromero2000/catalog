<?php

namespace Modules\Generals\Entities\AgeProtectionBanner\Facades;

use Illuminate\Support\Facades\Facade;

class AgeProtectionBanner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ageprotectionbanner';
    }
}
