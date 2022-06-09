<?php

namespace Modules\PawnShop\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\FasecoldaPriceRateRepository;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces\FasecoldaPriceRateRepositoryInterface;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces\JewelryQualityRepositoryInterface;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\JewelryQualityRepository;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces\PawnItemCategoryRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemCategories\Repositories\PawnItemCategoryRepository;
use Modules\PawnShop\Entities\PawnItems\Repositories\Interfaces\PawnItemRepositoryInterface;
use Modules\PawnShop\Entities\PawnItems\Repositories\PawnItemRepository;
use Modules\PawnShop\Entities\PawnItemStatuses\Repositories\Interfaces\PawnItemStatusRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemStatuses\Repositories\PawnItemStatusRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PawnItemStatusRepositoryInterface::class,
            PawnItemStatusRepository::class
        );

        $this->app->bind(
            FasecoldaPriceRateRepositoryInterface::class,
            FasecoldaPriceRateRepository::class
        );

        $this->app->bind(
            JewelryQualityRepositoryInterface::class,
            JewelryQualityRepository::class
        );

        $this->app->bind(
            PawnItemCategoryRepositoryInterface::class,
            PawnItemCategoryRepository::class
        );

        $this->app->bind(
            PawnItemRepositoryInterface::class,
            PawnItemRepository::class
        );
    }
}
