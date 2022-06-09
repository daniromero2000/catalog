<?php

namespace Modules\XisfoPay\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\ChaseTransferAmountUseCase;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\Interfaces\ChaseTransferAmountUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\UseCases\ChaseTransferUseCase;
use Modules\XisfoPay\Entities\ChaseTransfers\UseCases\Interfaces\ChaseTransferUseCaseInterface;
use Modules\XisfoPay\Entities\ContractCommentaries\UseCases\ContractCommentaryUseCase;
use Modules\XisfoPay\Entities\ContractCommentaries\UseCases\Interfaces\ContractCommentaryUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRates\UseCases\ContractRateUseCase;
use Modules\XisfoPay\Entities\ContractRates\UseCases\Interfaces\ContractRateUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\ContractRenewalUseCase;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\UseCases\ContractRequestCommentaryUseCase;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\UseCases\Interfaces\ContractRequestCommentaryUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\ContractRequestUseCase;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces\ContractRequestUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\ContractRequestStatusesLogUseCase;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\Interfaces\ContractRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases\ContractRequestStreamAccountCommissionUseCase;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases\Interfaces\ContractRequestStreamAccountCommissionUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\ContractRequestStreamAccountUseCase;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\Interfaces\ContractRequestStreamAccountUseCaseInterface;
use Modules\XisfoPay\Entities\Contracts\UseCases\ContractUseCase;
use Modules\XisfoPay\Entities\Contracts\UseCases\Interfaces\ContractUseCaseInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\ContractStatusesLogUseCase;
use Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\Interfaces\ContractStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces\PaymentBankTransferUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\PaymentBankTransferUseCase;
use Modules\XisfoPay\Entities\PaymentCuts\UseCases\Interfaces\PaymentCutUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentCuts\UseCases\PaymentCutUseCase;
use Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases\Interfaces\ChaseTransferTrmUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases\ChaseTransferTrmUseCase;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\PaymentRequestAdvanceUseCase;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\PaymentRequestUseCase;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces\PaymentRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\PaymentRequestStatusesLogUseCase;
use Modules\XisfoPay\Entities\Pricing\UseCases\Interfaces\PricingUseCaseInterface;
use Modules\XisfoPay\Entities\Pricing\UseCases\PricingUseCase;
use Modules\XisfoPay\Entities\XisfoPayParameters\UseCases\Interfaces\XisfoPayParameterUseCaseInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\UseCases\XisfoPayParameterUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PaymentRequestUseCaseInterface::class,
            PaymentRequestUseCase::class
        );

        $this->app->bind(
            PaymentRequestAdvanceUseCaseInterface::class,
            PaymentRequestAdvanceUseCase::class
        );

        $this->app->bind(
            PaymentBankTransferUseCaseInterface::class,
            PaymentBankTransferUseCase::class
        );

        $this->app->bind(
            ContractCommentaryUseCaseInterface::class,
            ContractCommentaryUseCase::class
        );

        $this->app->bind(
            ContractRequestCommentaryUseCaseInterface::class,
            ContractRequestCommentaryUseCase::class
        );

        $this->app->bind(
            ContractRateUseCaseInterface::class,
            ContractRateUseCase::class
        );

        $this->app->bind(
            PaymentCutUseCaseInterface::class,
            PaymentCutUseCase::class
        );

        $this->app->bind(
            ChaseTransferTrmUseCaseInterface::class,
            ChaseTransferTrmUseCase::class
        );

        $this->app->bind(
            XisfoPayParameterUseCaseInterface::class,
            XisfoPayParameterUseCase::class
        );

        $this->app->bind(
            ContractRenewalUseCaseInterface::class,
            ContractRenewalUseCase::class
        );

        $this->app->bind(
            PaymentRequestStatusesLogUseCaseInterface::class,
            PaymentRequestStatusesLogUseCase::class
        );

        $this->app->bind(
            ContractStatusesLogUseCaseInterface::class,
            ContractStatusesLogUseCase::class
        );

        $this->app->bind(
            ContractRequestStatusesLogUseCaseInterface::class,
            ContractRequestStatusesLogUseCase::class
        );

        $this->app->bind(
            ContractUseCaseInterface::class,
            ContractUseCase::class
        );

        $this->app->bind(
            ContractRequestUseCaseInterface::class,
            ContractRequestUseCase::class
        );

        $this->app->bind(
            ContractRequestStreamAccountUseCaseInterface::class,
            ContractRequestStreamAccountUseCase::class
        );

        $this->app->bind(
            ContractRequestStreamAccountCommissionUseCaseInterface::class,
            ContractRequestStreamAccountCommissionUseCase::class
        );

        $this->app->bind(
            ContractRequestStreamAccountUseCaseInterface::class,
            ContractRequestStreamAccountUseCase::class
        );

        $this->app->bind(
            ChaseTransferUseCaseInterface::class,
            ChaseTransferUseCase::class
        );

        $this->app->bind(
            ChaseTransferAmountUseCaseInterface::class,
            ChaseTransferAmountUseCase::class
        );

        $this->app->bind(
            PricingUseCaseInterface::class,
            PricingUseCase::class
        );
    }
}
