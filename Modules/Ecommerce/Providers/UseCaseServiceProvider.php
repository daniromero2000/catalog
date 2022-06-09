<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ecommerce\Entities\Attributes\UseCases\AttributeUseCase;
use Modules\Ecommerce\Entities\Attributes\UseCases\Interfaces\AttributeUseCaseInterface;
use Modules\Ecommerce\Entities\AttributeValues\UseCases\AttributeValueUseCase;
use Modules\Ecommerce\Entities\AttributeValues\UseCases\Interfaces\AttributeValueUseCaseInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AttributeUseCaseInterface::class,
            AttributeUseCase::class
        );

        $this->app->bind(
            AttributeValueUseCaseInterface::class,
            AttributeValueUseCase::class
        );
    }
}
