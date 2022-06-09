<?php

namespace Modules\Banking\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Banking\Entities\Banks\Repositories\BankRepository;
use Modules\Banking\Entities\BankAccounts\Repositories\BankAccountRepository;
use Modules\Banking\Entities\BankAccounts\Repositories\Interfaces\BankAccountRepositoryInterface;
use Modules\Banking\Entities\BankMovements\Repositories\BankMovementRepository;
use Modules\Banking\Entities\BankMovements\Repositories\Interfaces\BankMovementRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BankRepositoryInterface::class,
            BankRepository::class
        );

        $this->app->bind(
            BankMovementRepositoryInterface::class,
            BankMovementRepository::class
        );

        $this->app->bind(
            BankAccountRepositoryInterface::class,
            BankAccountRepository::class
        );
    }
}
