<?php

namespace Modules\Pqrs\Providers;

use Modules\Pqrs\Entities\Pqrs\Repositories\PqrRepository;
use Modules\Pqrs\Entities\Pqrs\Repositories\Interfaces\PqrRepositoryInterface;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\PqrStatusRepository;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces\PqrStatusRepositoryInterface;
use Modules\Pqrs\Entities\PqrCommentaries\Repositories\PqrCommentaryRepository;
use Modules\Pqrs\Entities\PqrCommentaries\Repositories\Interfaces\PqrCommentaryRepositoryInterface;
use Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories\PqrsStatusesLogRepository;
use Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories\Interfaces\PqrsStatusesLogRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PqrRepositoryInterface::class,
            PqrRepository         ::class
        );

        $this->app->bind(
            PqrStatusRepositoryInterface::class,
            PqrStatusRepository         ::class
        );

        $this->app->bind(
            PqrCommentaryRepositoryInterface::class,
            PqrCommentaryRepository         ::class
        );

        $this->app->bind(
            PqrsStatusesLogRepositoryInterface::class,
            PqrsStatusesLogRepository         ::class
        );
    }
}
