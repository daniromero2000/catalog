<?php

namespace Modules\CamStudio\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\CammodelBannedCountryRepository;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\CammodelCategoryRepository;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelFines\Repositories\CammodelFineRepository;
use Modules\CamStudio\Entities\CammodelFines\Repositories\Interfaces\CammodelFineRepositoryInterface;
use Modules\CamStudio\Entities\CammodelImages\Repositories\CammodelImageRepository;
use Modules\CamStudio\Entities\CammodelImages\Repositories\Interfaces\CammodelImageRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\CammodelSocialMediaPhoneRepository;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\CammodelSocialMediaRepository;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\CammodelStreamAccountRepository;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\CammodelWorkReportRepository;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\Interfaces\CammodelWorkReportRepositoryInterface;
use Modules\CamStudio\Entities\Fouls\Repositories\FoulRepository;
use Modules\CamStudio\Entities\Fouls\Repositories\Interfaces\FoulRepositoryInterface;
use Modules\CamStudio\Entities\Rooms\Repositories\Interfaces\RoomRepositoryInterface;
use Modules\CamStudio\Entities\Rooms\Repositories\RoomRepository;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;
use Modules\CamStudio\Entities\SocialStats\Repositories\SocialStatRepository;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\Repositories\StreamingStatRepository;
use Modules\CamStudio\Entities\CammodelPayrolls\Repositories\CammodelPayrollRepository;
use Modules\CamStudio\Entities\CammodelPayrolls\Repositories\Interfaces\CammodelPayrollRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\CammodelStreamingIncomeRepository;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\CammodelTipperRepository;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\Interfaces\CammodelTipperRepositoryInterface;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\CammodelTipperSocialMediaRepository;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\Interfaces\CammodelTipperSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories\CammodelWorkReportCommentaryRepository;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories\Interfaces\CammodelWorkReportCommentaryRepositoryInterface;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories\CamstudioReportCommentaryRepository;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories\Interfaces\CamstudioReportCommentaryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CammodelBannedCountryRepositoryInterface::class,
            CammodelBannedCountryRepository::class
        );

        $this->app->bind(
            CammodelRepositoryInterface::class,
            CammodelRepository::class
        );

        $this->app->bind(
            CammodelCategoryRepositoryInterface::class,
            CammodelCategoryRepository::class
        );

        $this->app->bind(
            CammodelSocialMediaRepositoryInterface::class,
            CammodelSocialMediaRepository::class
        );

        $this->app->bind(
            CammodelSocialMediaPhoneRepositoryInterface::class,
            CammodelSocialMediaPhoneRepository::class
        );

        $this->app->bind(
            CammodelStreamAccountRepositoryInterface::class,
            CammodelStreamAccountRepository::class
        );

        $this->app->bind(
            StreamingStatRepositoryInterface::class,
            StreamingStatRepository::class
        );

        $this->app->bind(
            SocialStatRepositoryInterface::class,
            SocialStatRepository::class
        );

        $this->app->bind(
            FoulRepositoryInterface::class,
            FoulRepository::class
        );

        $this->app->bind(
            GoalRepositoryInterface::class,
            GoalRepository::class
        );

        $this->app->bind(
            RoomRepositoryInterface::class,
            RoomRepository::class
        );

        $this->app->bind(
            CammodelFineRepositoryInterface::class,
            CammodelFineRepository::class
        );

        $this->app->bind(
            CammodelWorkReportRepositoryInterface::class,
            CammodelWorkReportRepository::class
        );

        $this->app->bind(
            CammodelPayrollRepositoryInterface::class,
            CammodelPayrollRepository::class
        );

        $this->app->bind(
            CammodelStreamingIncomeRepositoryInterface::class,
            CammodelStreamingIncomeRepository::class
        );

        $this->app->bind(
            CamstudioReportCommentaryRepositoryInterface::class,
            CamstudioReportCommentaryRepository::class
        );

        $this->app->bind(
            CammodelWorkReportCommentaryRepositoryInterface::class,
            CammodelWorkReportCommentaryRepository::class
        );

        $this->app->bind(
            CammodelTipperRepositoryInterface::class,
            CammodelTipperRepository::class
        );

        $this->app->bind(
            CammodelTipperSocialMediaRepositoryInterface::class,
            CammodelTipperSocialMediaRepository::class
        );

        $this->app->bind(
            CammodelImageRepositoryInterface::class,
            CammodelImageRepository::class
        );
    }
}
