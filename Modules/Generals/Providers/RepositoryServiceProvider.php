<?php

namespace Modules\Generals\Providers;

use Modules\Generals\Entities\Schedulers\Repositories\SchedulerRepository;
use Modules\Generals\Entities\Schedulers\Repositories\Interfaces\SchedulerRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\CityRepository;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\CountryRepository;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\ProvinceRepository;
use Modules\Generals\Entities\Epss\Repositories\EpsRepository;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Modules\Generals\Entities\Genres\Repositories\GenreRepository;
use Modules\Generals\Entities\Genres\Repositories\Interfaces\GenreRepositoryInterface;
use Modules\Generals\Entities\CivilStatuses\Repositories\CivilStatusRepository;
use Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces\CivilStatusRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\IdentityTypeRepository;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\ProfessionsGroups\Repositories\ProfessionsGroupRepository;
use Modules\Generals\Entities\ProfessionsGroups\Repositories\Interfaces\ProfessionsGroupRepositoryInterface;
use Modules\Generals\Entities\ProfessionsLists\Repositories\ProfessionsListRepository;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Generals\Entities\ReferenceTypes\Repositories\ReferenceTypeRepository;
use Modules\Generals\Entities\ReferenceTypes\Repositories\Interfaces\ReferenceTypeRepositoryInterface;
use Modules\Generals\Entities\Relationships\Repositories\RelationshipRepository;
use Modules\Generals\Entities\Relationships\Repositories\Interfaces\RelationshipRepositoryInterface;
use Modules\Generals\Entities\Scholarities\Repositories\ScholarityRepository;
use Modules\Generals\Entities\Scholarities\Repositories\Interfaces\ScholarityRepositoryInterface;
use Modules\Generals\Entities\Stratums\Repositories\StratumRepository;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Modules\Generals\Entities\Housings\Repositories\HousingRepository;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Modules\Generals\Entities\VehicleBrands\Repositories\VehicleBrandRepository;
use Modules\Generals\Entities\VehicleBrands\Repositories\Interfaces\VehicleBrandRepositoryInterface;
use Modules\Generals\Entities\VehicleTypes\Repositories\VehicleTypeRepository;
use Modules\Generals\Entities\VehicleTypes\Repositories\Interfaces\VehicleTypeRepositoryInterface;
use Modules\Generals\Entities\EconomicActivityTypes\Repositories\EconomicActivityTypeRepository;
use Modules\Generals\Entities\EconomicActivityTypes\Repositories\Interfaces\EconomicActivityTypeRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Banking\Entities\Banks\Repositories\BankRepository;
use Illuminate\Support\ServiceProvider;
use Modules\Generals\Entities\PasswordResets\Repositories\Interfaces\PasswordResetRepositoryInterface;
use Modules\Generals\Entities\PasswordResets\Repositories\PasswordResetRepository;
use Modules\Generals\Entities\SocialMedias\Repositories\SocialMediaRepository;
use Modules\Generals\Entities\SocialMedias\Repositories\Interfaces\SocialMediaRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            SocialMediaRepositoryInterface::class,
            SocialMediaRepository::class
        );

        $this->app->bind(
            SchedulerRepositoryInterface::class,
            SchedulerRepository::class
        );

        $this->app->bind(
            SubsidiaryRepositoryInterface::class,
            SubsidiaryRepository::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );

        $this->app->bind(
            ProvinceRepositoryInterface::class,
            ProvinceRepository::class
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            CityRepository::class
        );

        $this->app->bind(
            EpsRepositoryInterface::class,
            EpsRepository::class
        );

        $this->app->bind(
            GenreRepositoryInterface::class,
            GenreRepository::class
        );

        $this->app->bind(
            CivilStatusRepositoryInterface::class,
            CivilStatusRepository::class
        );

        $this->app->bind(
            IdentityTypeRepositoryInterface::class,
            IdentityTypeRepository::class
        );

        $this->app->bind(
            ProfessionsGroupRepositoryInterface::class,
            ProfessionsGroupRepository::class
        );

        $this->app->bind(
            ProfessionsListRepositoryInterface::class,
            ProfessionsListRepository::class
        );

        $this->app->bind(
            ReferenceTypeRepositoryInterface::class,
            ReferenceTypeRepository::class
        );

        $this->app->bind(
            RelationshipRepositoryInterface::class,
            RelationshipRepository::class
        );

        $this->app->bind(
            ScholarityRepositoryInterface::class,
            ScholarityRepository::class
        );

        $this->app->bind(
            StratumRepositoryInterface::class,
            StratumRepository::class
        );

        $this->app->bind(
            HousingRepositoryInterface::class,
            HousingRepository::class
        );

        $this->app->bind(
            VehicleBrandRepositoryInterface::class,
            VehicleBrandRepository::class
        );

        $this->app->bind(
            VehicleTypeRepositoryInterface::class,
            VehicleTypeRepository::class
        );

        $this->app->bind(
            EconomicActivityTypeRepositoryInterface::class,
            EconomicActivityTypeRepository::class
        );

        $this->app->bind(
            ToolRepositoryInterface::class,
            ToolRepository::class
        );

        $this->app->bind(
            BankRepositoryInterface::class,
            BankRepository::class
        );

        $this->app->bind(
            PasswordResetRepositoryInterface::class,
            PasswordResetRepository::class
        );
    }
}
