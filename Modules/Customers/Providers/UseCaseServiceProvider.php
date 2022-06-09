<?php

namespace Modules\Customers\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Customers\Entities\CustomerBankAccounts\UseCases\CustomerBankAccountUseCase;
use Modules\Customers\Entities\CustomerBankAccounts\UseCases\Interfaces\CustomerBankAccountUseCaseInterface;
use Modules\Customers\Entities\CustomerCompanies\UseCases\CustomerCompanyUseCase;
use Modules\Customers\Entities\CustomerCompanies\UseCases\Interfaces\CustomerCompanyUseCaseInterface;
use Modules\Customers\Entities\CustomerIdentities\UseCases\CustomerIdentityUseCase;
use Modules\Customers\Entities\CustomerIdentities\UseCases\Interfaces\CustomerIdentityUseCaseInterface;
use Modules\Customers\Entities\Customers\UseCases\CustomerUseCase;
use Modules\Customers\Entities\Customers\UseCases\Interfaces\CustomerUseCaseInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\CustomerStatusesLogUseCase;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;
use Modules\Customers\Entities\LeadCommentaries\UseCases\Interfaces\LeadCommentaryUseCaseInterface;
use Modules\Customers\Entities\LeadCommentaries\UseCases\LeadCommentaryUseCase;
use Modules\Customers\Entities\Leads\UseCases\Interfaces\LeadUseCaseInterface;
use Modules\Customers\Entities\Leads\UseCases\LeadUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadUseCaseInterface::class,
            LeadUseCase::class
        );

        $this->app->bind(
            LeadCommentaryUseCaseInterface::class,
            LeadCommentaryUseCase::class
        );

        $this->app->bind(
            CustomerStatusesLogUseCaseInterface::class,
            CustomerStatusesLogUseCase::class
        );

        $this->app->bind(
            CustomerBankAccountUseCaseInterface::class,
            CustomerBankAccountUseCase::class
        );

        $this->app->bind(
            CustomerIdentityUseCaseInterface::class,
            CustomerIdentityUseCase::class
        );

        $this->app->bind(
            CustomerCompanyUseCaseInterface::class,
            CustomerCompanyUseCase::class
        );

        $this->app->bind(
            CustomerUseCaseInterface::class,
            CustomerUseCase::class
        );
    }
}
