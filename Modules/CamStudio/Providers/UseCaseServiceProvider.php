<?php

namespace Modules\CamStudio\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CamStudio\Entities\CammodelBannedCountries\UseCases\CammodelBannedCountryUseCase;
use Modules\CamStudio\Entities\CammodelBannedCountries\UseCases\Interfaces\CammodelBannedCountryUseCaseInterface;
use Modules\CamStudio\Entities\CammodelCategories\UseCases\CammodelCategoryUseCase;
use Modules\CamStudio\Entities\CammodelCategories\UseCases\Interfaces\CammodelCategoryUseCaseInterface;
use Modules\CamStudio\Entities\CammodelFines\UseCases\CammodelFineUseCase;
use Modules\CamStudio\Entities\CammodelFines\UseCases\Interfaces\CammodelFineUseCaseInterface;
use Modules\CamStudio\Entities\CammodelImages\UseCases\CammodelImageUseCase;
use Modules\CamStudio\Entities\CammodelImages\UseCases\Interfaces\CammodelImageUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\UseCases\CammodelUseCase;
use Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces\CammodelUseCaseInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\UseCases\CammodelWorkReportUseCase;
use Modules\CamStudio\Entities\CammodelWorkReports\UseCases\Interfaces\CammodelWorkReportUseCaseInterface;
use Modules\CamStudio\Entities\Fouls\UseCases\FoulUseCase;
use Modules\CamStudio\Entities\Fouls\UseCases\Interfaces\FoulUseCaseInterface;
use Modules\CamStudio\Entities\Rooms\UseCases\Interfaces\RoomUseCaseInterface;
use Modules\CamStudio\Entities\Rooms\UseCases\RoomUseCase;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\CammodelPayrollUseCase;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces\CammodelPayrollUseCaseInterface;
use Modules\CamStudio\Entities\CammodelStats\UseCases\CammodelStatUseCase;
use Modules\CamStudio\Entities\CammodelStats\UseCases\Interfaces\CammodelStatUseCaseInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\CammodelStreamingIncomeUseCase;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces\CammodelStreamingIncomeUseCaseInterface;
use Modules\CamStudio\Entities\CammodelTippers\UseCases\CammodelTipperUseCase;
use Modules\CamStudio\Entities\CammodelTippers\UseCases\Interfaces\CammodelTipperUseCaseInterface;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases\CammodelTipperSocialMediaUseCase;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases\Interfaces\CammodelTipperSocialMediaUseCaseInterface;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases\CammodelWorkReportCommentaryUseCase;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases\Interfaces\CammodelWorkReportCommentaryUseCaseInterface;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\Interfaces\CamstudioReportCommentaryUseCaseInterface;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\CamstudioReportCommentaryUseCase;
use Modules\CamStudio\Entities\CamstudioReports\UseCases\CamstudioReportUseCase;
use Modules\CamStudio\Entities\CamstudioReports\UseCases\Interfaces\CamstudioReportUseCaseInterface;
use Modules\CamStudio\Entities\StreamingStats\UseCases\Interfaces\StreamingStatUseCaseInterface;
use Modules\CamStudio\Entities\StreamingStats\UseCases\StreamingStatUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CammodelUseCaseInterface::class,
            CammodelUseCase::class
        );

        $this->app->bind(
            CammodelFineUseCaseInterface::class,
            CammodelFineUseCase::class
        );

        $this->app->bind(
            FoulUseCaseInterface::class,
            FoulUseCase::class
        );


        $this->app->bind(
            RoomUseCaseInterface::class,
            RoomUseCase::class
        );

        $this->app->bind(
            CammodelWorkReportUseCaseInterface::class,
            CammodelWorkReportUseCase::class
        );

        $this->app->bind(
            CammodelPayrollUseCaseInterface::class,
            CammodelPayrollUseCase::class
        );

        $this->app->bind(
            CammodelStreamingIncomeUseCaseInterface::class,
            CammodelStreamingIncomeUseCase::class
        );

        $this->app->bind(
            CammodelStatUseCaseInterface::class,
            CammodelStatUseCase::class
        );

        $this->app->bind(
            StreamingStatUseCaseInterface::class,
            StreamingStatUseCase::class
        );

        $this->app->bind(
            CamstudioReportUseCaseInterface::class,
            CamstudioReportUseCase::class
        );

        $this->app->bind(
            CamstudioReportCommentaryUseCaseInterface::class,
            CamstudioReportCommentaryUseCase::class
        );

        $this->app->bind(
            CammodelWorkReportCommentaryUseCaseInterface::class,
            CammodelWorkReportCommentaryUseCase::class
        );

        $this->app->bind(
            CammodelBannedCountryUseCaseInterface::class,
            CammodelBannedCountryUseCase::class
        );

        $this->app->bind(
            CammodelCategoryUseCaseInterface::class,
            CammodelCategoryUseCase::class
        );

        $this->app->bind(
            CammodelTipperUseCaseInterface::class,
            CammodelTipperUseCase::class
        );

        $this->app->bind(
            CammodelTipperSocialMediaUseCaseInterface::class,
            CammodelTipperSocialMediaUseCase::class
        );

        $this->app->bind(
            CammodelImageUseCaseInterface::class,
            CammodelImageUseCase::class
        );
    }
}
