<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Companies\Entities\EmployeeCommentaries\UseCases\EmployeeCommentaryUseCase;
use Modules\Companies\Entities\EmployeeCommentaries\UseCases\Interfaces\EmployeeCommentaryUseCaseInterface;
use Modules\Companies\Entities\Goals\UseCases\GoalUseCase;
use Modules\Companies\Entities\Goals\UseCases\Interfaces\GoalUseCaseInterface;
use Modules\Companies\Entities\Kpis\UseCases\Interfaces\KpiUseCaseInterface;
use Modules\Companies\Entities\Kpis\UseCases\KpiUseCase;
use Modules\Companies\Entities\Shifts\UseCases\Interfaces\ShiftUseCaseInterface;
use Modules\Companies\Entities\Shifts\UseCases\ShiftUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ShiftUseCaseInterface::class,
            ShiftUseCase::class
        );

        $this->app->bind(
            GoalUseCaseInterface::class,
            GoalUseCase::class
        );

        $this->app->bind(
            KpiUseCaseInterface::class,
            KpiUseCase::class
        );

        $this->app->bind(
            EmployeeCommentaryUseCaseInterface::class,
            EmployeeCommentaryUseCase::class
        );
    }
}
