<?php

namespace Modules\Banking\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Banking\Entities\Banks\UseCases\BankUseCase;
use Modules\Banking\Entities\Banks\UseCases\Interfaces\BankUseCaseInterface;
use Modules\Banking\Entities\BankAccounts\UseCases\BankAccountUseCase;
use Modules\Banking\Entities\BankAccounts\UseCases\Interfaces\BankAccountUseCaseInterface;
use Modules\Banking\Entities\Trms\UseCases\Interfaces\TrmUseCaseInterface;
use Modules\Banking\Entities\Trms\UseCases\TrmUseCase;
use Modules\Banking\Entities\BankMovements\UseCases\BankMovementUseCase;
use Modules\Banking\Entities\BankMovements\UseCases\Interfaces\BankMovementUseCaseInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BankUseCaseInterface::class,
            BankUseCase::class
        );

        $this->app->bind(
            BankMovementUseCaseInterface::class,
            BankMovementUseCase::class
        );

        $this->app->bind(
            BankAccountUseCaseInterface::class,
            BankAccountUseCase::class
        );

        $this->app->bind(
            TrmUseCaseInterface::class,
            TrmUseCase::class
        );
    }
}
