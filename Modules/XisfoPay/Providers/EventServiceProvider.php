<?php

namespace Modules\XisfoPay\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\XisfoPay\Events\ContractRenewals\ContractRenewalWasCreated;
use Modules\XisfoPay\Events\ContractRequests\ContractRequestWasCreated;
use Modules\XisfoPay\Events\ContractRequests\Front\ContractRequestFrontWasCreated;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferDone;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWasCreated;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWereCreated;
use Modules\XisfoPay\Events\PaymentCuts\PaymentCutWasCreated;
use Modules\XisfoPay\Events\PaymentRequestAdvances\PaymentRequestAdvanceCreated;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasApproved;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasCreated;
use Modules\XisfoPay\Listeners\ContractRenewals\NotifyUsersOfANewContractRenewal;
use Modules\XisfoPay\Listeners\ContractRequests\Front\NotifyCustomerOfANewContractRequest;
use Modules\XisfoPay\Listeners\ContractRequests\NotifyUsersOfANewContractRequest;
use Modules\XisfoPay\Listeners\PaymentBankTransfers\NotifyCustomerOfNewPaymentBankTransfer;
use Modules\XisfoPay\Listeners\PaymentBankTransfers\NotifyUsersOfNewPaymentBankTransfer;
use Modules\XisfoPay\Listeners\PaymentBankTransfers\NotifyUsersOfNewPaymentBankTransfers;
use Modules\XisfoPay\Listeners\PaymentCuts\NotifyUsersOfANewPaymentCut;
use Modules\XisfoPay\Listeners\PaymentRequestAdvances\SendNewPaymentRequestAdvanceNotification;
use Modules\XisfoPay\Listeners\PaymentRequests\NotifyCustomerOfPaymentRequestApprovation;
use Modules\XisfoPay\Listeners\PaymentRequests\NotifyUsersOfANewPaymentRequest;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ContractRenewalWasCreated::class => [
            NotifyUsersOfANewContractRenewal::class,
        ],

        PaymentCutWasCreated::class => [
            NotifyUsersOfANewPaymentCut::class,
        ],

        PaymentBankTransferWereCreated::class => [
            NotifyUsersOfNewPaymentBankTransfers::class,
        ],

        PaymentBankTransferWasCreated::class => [
            NotifyUsersOfNewPaymentBankTransfer::class,
        ],

        PaymentBankTransferDone::class => [
            NotifyCustomerOfNewPaymentBankTransfer::class,
        ],

        PaymentRequestWasCreated::class => [
            NotifyUsersOfANewPaymentRequest::class,
        ],

        PaymentRequestWasApproved::class => [
            NotifyCustomerOfPaymentRequestApprovation::class,
        ],

        ContractRequestWasCreated::class => [
            NotifyUsersOfANewContractRequest::class,
        ],

        ContractRequestFrontWasCreated::class => [
            NotifyCustomerOfANewContractRequest::class,
        ],

        PaymentRequestAdvanceCreated::class => [
            SendNewPaymentRequestAdvanceNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
