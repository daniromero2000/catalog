<?php

namespace Modules\Streamings\Providers;

use Modules\Streamings\Entities\Streamings\Repositories\StreamingRepository;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StreamingRepositoryInterface::class,
            StreamingRepository::class
        );
    }
}
