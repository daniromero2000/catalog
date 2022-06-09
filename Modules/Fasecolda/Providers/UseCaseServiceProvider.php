<?php

namespace Modules\Fasecolda\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\FasecoldaCodeUseCase;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces\FasecoldaPriceUseCaseInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\FasecoldaPriceUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            FasecoldaPriceUseCaseInterface::class,
            FasecoldaPriceUseCase::class
        );

        $this->app->bind(
            FasecoldaCodeUseCaseInterface::class,
            FasecoldaCodeUseCase::class
        );
    }
}
