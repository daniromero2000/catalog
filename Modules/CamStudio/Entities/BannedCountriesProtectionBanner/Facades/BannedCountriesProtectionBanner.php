<?php

namespace Modules\CamStudio\Entities\BannedCountriesProtectionBanner\Facades;

use Illuminate\Support\Facades\Facade;

class BannedCountriesProtectionBanner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bannedcountriesprotectionbanner';
    }
}
