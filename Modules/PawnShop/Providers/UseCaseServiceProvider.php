<?php

namespace Modules\PawnShop\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases\FasecoldaPriceRateUseCase;
use Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases\Interfaces\FasecoldaPriceRateUseCaseInterface;
use Modules\PawnShop\Entities\JewelryQualities\UseCases\Interfaces\JewelryQualityUseCaseInterface;
use Modules\PawnShop\Entities\JewelryQualities\UseCases\JewelryQualityUseCase;
use Modules\PawnShop\Entities\PawnItemCategories\UseCases\Interfaces\PawnItemCategoryUseCaseInterface;
use Modules\PawnShop\Entities\PawnItemCategories\UseCases\PawnItemCategoryUseCase;
use Modules\PawnShop\Entities\PawnItems\UseCases\Interfaces\PawnItemUseCaseInterface;
use Modules\PawnShop\Entities\PawnItems\UseCases\PawnItemUseCase;
use Modules\PawnShop\Entities\PawnItemStatuses\UseCases\Interfaces\PawnItemStatusUseCaseInterface;
use Modules\PawnShop\Entities\PawnItemStatuses\UseCases\PawnItemStatusUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PawnItemStatusUseCaseInterface::class,
            PawnItemStatusUseCase::class
        );

        $this->app->bind(
            PawnItemCategoryUseCaseInterface::class,
            PawnItemCategoryUseCase::class
        );

        $this->app->bind(
            FasecoldaPriceRateUseCaseInterface::class,
            FasecoldaPriceRateUseCase::class
        );

        $this->app->bind(
            PawnItemUseCaseInterface::class,
            PawnItemUseCase::class
        );

        $this->app->bind(
            JewelryQualityUseCaseInterface::class,
            JewelryQualityUseCase::class
        );
    }
}
