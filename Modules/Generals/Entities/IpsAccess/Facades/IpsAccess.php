<?php

namespace Modules\Generals\Entities\IpsAccess\Facades;

use Illuminate\Support\Facades\Facade;

class IpsAccess extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipsaccess';
    }
}
