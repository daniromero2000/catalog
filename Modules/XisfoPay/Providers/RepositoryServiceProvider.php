<?php

namespace Modules\XisfoPay\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\ChaseTransferAmountRepository;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\Interfaces\ChaseTransferAmountRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\ChaseTransferRepository;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces\ChaseTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\ContractRequestStreamAccountRepository;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRates\Repositories\ContractRateRepository;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\ContractStatusRepository;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\Interfaces\ContractStatusRepositoryInterface;
use Modules\XisfoPay\Entities\Contracts\Repositories\ContractRepository;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\ContractRenewalRepository;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\Interfaces\ContractRenewalRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\ContractRequestRepository;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\ContractRequestStatusRepository;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\Interfaces\ContractRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\ContractCommentaries\Repositories\ContractCommentaryRepository;
use Modules\XisfoPay\Entities\ContractCommentaries\Repositories\Interfaces\ContractCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\ContractStatusesLogRepository;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\Interfaces\ContractStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories\ContractRequestCommentaryRepository;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories\Interfaces\ContractRequestCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\ContractRequestStatusesLogRepository;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\Interfaces\ContractRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\ContractRequestStreamAccountCommissionRepository;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\PaymentRequestStatusRepository;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories\PaymentRequestCommentaryRepository;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories\Interfaces\PaymentRequestCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\PaymentRequestStatusesLogRepository;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces\PaymentRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\PaymentRequestAdvanceRepository;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\PaymentRequestRepository;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\PaymentCutRepository;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\Interfaces\PaymentCutRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestImages\Repositories\PaymentRequestImageRepository;
use Modules\XisfoPay\Entities\PaymentRequestImages\Repositories\Interfaces\PaymentRequestImageRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\PaymentBankTransferRepository;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\ChaseTransferTrmRepository;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Repositories\Interfaces\PaymentRequestAdvanceImageRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Repositories\PaymentRequestAdvanceImageRepository;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\XisfoServiceRepository;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\Interfaces\XisfoServiceRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoAppointments\Repositories\XisfoAppointmentRepository;
use Modules\XisfoPay\Entities\XisfoAppointments\Repositories\Interfaces\XisfoAppointmentRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\Repositories\Interfaces\XisfoPayParameterRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\Repositories\XisfoPayParameterRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            XisfoAppointmentRepositoryInterface::class,
            XisfoAppointmentRepository::class
        );

        $this->app->bind(
            XisfoServiceRepositoryInterface::class,
            XisfoServiceRepository::class
        );

        $this->app->bind(
            ContractRequestStreamAccountRepositoryInterface::class,
            ContractRequestStreamAccountRepository::class
        );

        $this->app->bind(
            ContractRequestStreamAccountCommissionRepositoryInterface::class,
            ContractRequestStreamAccountCommissionRepository::class
        );

        $this->app->bind(
            PaymentBankTransferRepositoryInterface::class,
            PaymentBankTransferRepository::class
        );

        $this->app->bind(
            ContractRateRepositoryInterface::class,
            ContractRateRepository::class
        );

        $this->app->bind(
            ContractStatusesLogRepositoryInterface::class,
            ContractStatusesLogRepository::class
        );

        $this->app->bind(
            ContractRequestStatusesLogRepositoryInterface::class,
            ContractRequestStatusesLogRepository::class
        );

        $this->app->bind(
            PaymentRequestStatusesLogRepositoryInterface::class,
            PaymentRequestStatusesLogRepository::class
        );

        $this->app->bind(
            PaymentRequestAdvanceRepositoryInterface::class,
            PaymentRequestAdvanceRepository::class
        );

        $this->app->bind(
            ContractCommentaryRepositoryInterface::class,
            ContractCommentaryRepository::class
        );

        $this->app->bind(
            ContractRequestCommentaryRepositoryInterface::class,
            ContractRequestCommentaryRepository::class
        );

        $this->app->bind(
            PaymentRequestCommentaryRepositoryInterface::class,
            PaymentRequestCommentaryRepository::class
        );

        $this->app->bind(
            PaymentRequestRepositoryInterface::class,
            PaymentRequestRepository::class
        );

        $this->app->bind(
            PaymentRequestAdvanceImageRepositoryInterface::class,
            PaymentRequestAdvanceImageRepository::class
        );

        $this->app->bind(
            PaymentCutRepositoryInterface::class,
            PaymentCutRepository::class
        );

        $this->app->bind(
            ContractStatusRepositoryInterface::class,
            ContractStatusRepository::class
        );

        $this->app->bind(
            ContractRequestStatusRepositoryInterface::class,
            ContractRequestStatusRepository::class
        );

        $this->app->bind(
            PaymentRequestStatusRepositoryInterface::class,
            PaymentRequestStatusRepository::class
        );

        $this->app->bind(
            ContractRepositoryInterface::class,
            ContractRepository::class
        );

        $this->app->bind(
            ContractRenewalRepositoryInterface::class,
            ContractRenewalRepository::class
        );

        $this->app->bind(
            ContractRequestRepositoryInterface::class,
            ContractRequestRepository::class
        );

        $this->app->bind(
            ChaseTransferTrmRepositoryInterface::class,
            ChaseTransferTrmRepository::class
        );

        $this->app->bind(
            XisfoPayParameterRepositoryInterface::class,
            XisfoPayParameterRepository::class
        );

        $this->app->bind(
            PaymentRequestImageRepositoryInterface::class,
            PaymentRequestImageRepository::class
        );

        $this->app->bind(
            ChaseTransferRepositoryInterface::class,
            ChaseTransferRepository::class
        );

        $this->app->bind(
            ChaseTransferAmountRepositoryInterface::class,
            ChaseTransferAmountRepository::class
        );
    }
}
