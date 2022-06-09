<?php

namespace Modules\Streamings\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;
use Modules\Streamings\Entities\Streamings\UseCases\StreamingUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StreamingUseCaseInterface::class,
            StreamingUseCase::class
        );
    }
}
