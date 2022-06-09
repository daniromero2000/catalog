<?php

namespace Modules\Customers\Providers;

use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatuses\Repositories\CustomerStatusRepository;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerCommentaries\Repositories\CustomerCommentaryRepository;
use Modules\Customers\Entities\CustomerCommentaries\Repositories\Interfaces\CustomerCommentaryRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Repositories\CustomerAddressRepository;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Repositories\CustomerPhoneRepository;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\CustomerStatusesLogRepository;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerEmails\Repositories\CustomerEmailRepository;
use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Modules\Customers\Entities\CustomerChannels\Repositories\CustomerChannelRepository;
use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Repositories\CustomerIdentityRepository;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Modules\Customers\Entities\CustomerVehicles\Repositories\CustomerVehicleRepository;
use Modules\Customers\Entities\CustomerVehicles\Repositories\Interfaces\CustomerVehicleRepositoryInterface;
use Modules\Customers\Entities\CustomerProfessions\Repositories\CustomerProfessionRepository;
use Modules\Customers\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use Modules\Customers\Entities\CustomerReferences\Repositories\CustomerReferenceRepository;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Modules\Customers\Entities\CustomerEpss\Repositories\CustomerEpsRepository;
use Modules\Customers\Entities\CustomerEpss\Repositories\Interfaces\CustomerEpsRepositoryInterface;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\CustomerEconomicActivityRepository;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\Interfaces\CustomerEconomicActivityRepositoryInterface;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\NewsletterSubscriptionRepository;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces\NewsletterSubscriptionRepositoryInterface;
use Modules\Customers\Entities\Leads\Repositories\LeadRepository;
use Modules\Customers\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Customers\Entities\LeadStatuses\Repositories\LeadStatusRepository;
use Modules\Customers\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Modules\Customers\Entities\LeadStatusesLogs\Repositories\LeadStatusesLogRepository;
use Modules\Customers\Entities\LeadStatusesLogs\Repositories\Interfaces\LeadStatusesLogRepositoryInterface;
use Modules\Customers\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use Modules\Customers\Entities\Services\Repositories\ServiceRepository;
use Modules\Customers\Entities\CustomerCompanies\Repositories\CustomerCompanyRepository;
use Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces\CustomerCompanyRepositoryInterface;
use Modules\Customers\Entities\CustomerGroups\Repositories\CustomerGroupRepository;
use Modules\Customers\Entities\CustomerGroups\Repositories\Interfaces\CustomerGroupRepositoryInterface;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\CustomerBankAccountRepository;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\Interfaces\CustomerBankAccountRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Modules\Customers\Entities\LeadCommentaries\Repositories\Interfaces\LeadCommentaryRepositoryInterface;
use Modules\Customers\Entities\LeadCommentaries\Repositories\LeadCommentaryRepository;
use Modules\Customers\Entities\LeadReasons\Repositories\Interfaces\LeadReasonRepositoryInterface;
use Modules\Customers\Entities\LeadReasons\Repositories\LeadReasonRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CustomerCompanyRepositoryInterface::class,
            CustomerCompanyRepository::class
        );

        $this->app->bind(
            CustomerBankAccountRepositoryInterface::class,
            CustomerBankAccountRepository::class
        );

        $this->app->bind(
            CustomerGroupRepositoryInterface::class,
            CustomerGroupRepository::class
        );

        $this->app->bind(
            ServiceRepositoryInterface::class,
            ServiceRepository::class
        );

        $this->app->bind(
            LeadStatusesLogRepositoryInterface::class,
            LeadStatusesLogRepository::class
        );

        $this->app->bind(
           LeadCommentaryRepositoryInterface::class,
            LeadCommentaryRepository::class
       );

        $this->app->bind(
            LeadStatusRepositoryInterface::class,
            LeadStatusRepository::class
        );

        $this->app->bind(
            LeadReasonRepositoryInterface::class,
            LeadReasonRepository::class
        );

        $this->app->bind(
            LeadRepositoryInterface::class,
            LeadRepository::class
        );

        $this->app->bind(
            NewsletterSubscriptionRepositoryInterface::class,
            NewsletterSubscriptionRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            CustomerStatusRepositoryInterface::class,
            CustomerStatusRepository::class
        );

        $this->app->bind(
            CustomerCommentaryRepositoryInterface::class,
            CustomerCommentaryRepository::class
        );

        $this->app->bind(
            CustomerAddressRepositoryInterface::class,
            CustomerAddressRepository::class
        );

        $this->app->bind(
            CustomerPhoneRepositoryInterface::class,
            CustomerPhoneRepository::class
        );

        $this->app->bind(
            CustomerStatusesLogRepositoryInterface::class,
            CustomerStatusesLogRepository::class
        );

        $this->app->bind(
            CustomerEmailRepositoryInterface::class,
            CustomerEmailRepository::class
        );

        $this->app->bind(
            CustomerEmailRepositoryInterface::class,
            CustomerEmailRepository::class
        );

        $this->app->bind(
            CustomerChannelRepositoryInterface::class,
            CustomerChannelRepository::class
        );

        $this->app->bind(
            CustomerIdentityRepositoryInterface::class,
            CustomerIdentityRepository::class
        );

        $this->app->bind(
            CustomerVehicleRepositoryInterface::class,
            CustomerVehicleRepository::class
        );

        $this->app->bind(
            CustomerProfessionRepositoryInterface::class,
            CustomerProfessionRepository::class
        );

        $this->app->bind(
            CustomerReferenceRepositoryInterface::class,
            CustomerReferenceRepository::class
        );


        $this->app->bind(
            CustomerEpsRepositoryInterface::class,
            CustomerEpsRepository::class
        );

        $this->app->bind(
            CustomerEconomicActivityRepositoryInterface::class,
            CustomerEconomicActivityRepository::class
        );
    }
}
