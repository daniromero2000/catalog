<?php

namespace Modules\Fasecolda\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\FasecoldaCodeRepository;
use Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\Interfaces\FasecoldaCodeRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\FasecoldaPriceRepository;
use Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\Interfaces\FasecoldaPriceRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            FasecoldaCodeRepositoryInterface::class,
            FasecoldaCodeRepository::class
        );

        $this->app->bind(
            FasecoldaPriceRepositoryInterface::class,
            FasecoldaPriceRepository::class
        );
    }
}
