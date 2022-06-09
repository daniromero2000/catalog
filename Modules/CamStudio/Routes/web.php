<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::middleware(['throttle:admin'])->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::namespace('Cammodels')->group(function () {
                Route::resource('cammodels', 'CammodelsController');
                Route::get('remove-thumb', 'CammodelsController@removeThumbnail')->name('cammodels.remove.thumb');
                Route::get('cammodels/cammodel/profile', 'CammodelsController@getProfile')->name('cammodels.profile');
                Route::get('cammodels/cammodel/{id}/deactivate', 'CammodelsController@deactivate')->name('cammodels.deactivate');
                Route::get('cammodels/cammodel/{id}/activate', 'CammodelsController@activate')->name('cammodels.activate');
                Route::get('cammodels/inactive/list', 'CammodelsController@inactiveCammodelsList')->name('cammodels.inactive-list');
            });
            Route::namespace('CammodelCategories')->group(function () {
                Route::resource('cammodel-categories', 'CammodelCategoriesController');
                Route::put('api/update-cammodel-categories-order/{id}', 'CammodelCategoriesController@updateSortOrder');
                Route::get('remove-image-cammodel-categories', 'CammodelCategoriesController@removeImage')->name('cammodel-categories.remove.image');
            });

            Route::namespace('CammodelBannedCountries')->group(function () {
                Route::resource('banned-countries', 'CammodelBannedCountryController');
            });

            Route::namespace('CammodelFines')->group(function () {
                Route::resource('cammodel-fines', 'CammodelFinesController');
            });

            Route::namespace('CammodelSocialMedias')->group(function () {
                Route::resource('cammodel-social', 'CammodelSocialMediaController');
                Route::post('cammodel-social/verifyPass', 'CammodelSocialMediaController@verifyPass')->name('cammodel-social.verifyPass');
            });

            Route::namespace('CammodelStreamAccounts')->group(function () {
                Route::resource('cammodel-streamings', 'CammodelStreamAccountsController');
                Route::post('cammodel-streamings/verifyPass', 'CammodelStreamAccountsController@verifyPass')->name('cammodel-streamings.verifyPass');
            });

            Route::namespace('CammodelWorkReports')->group(function () {
                Route::resource('cammodel-work-reports', 'CammodelWorkReportsController');
            });

            Route::namespace('CammodelStreamingIncomes')->group(function () {
                Route::resource('cammodel-streaming-incomes', 'CammodelStreamingIncomesController');
                Route::post('cammodel-streaming-incomes/update/package/{id}', 'CammodelStreamingIncomesController@updatePackage')
                    ->name('cammodel-streaming-incomes.update-package');
                Route::get('cammodel-streaming-incomes/create/offline-incomes', 'CammodelStreamingIncomesController@createOffline')
                    ->name('cammodel-streaming-incomes.create-offline');
                Route::post('cammodel-streaming-incomes/store/offline-incomes', 'CammodelStreamingIncomesController@storeOffline')
                    ->name('cammodel-streaming-incomes.store-offline');
            });

            Route::namespace('CammodelStats')->group(function () {
                Route::resource('cammodel-stats', 'CammodelStatsController');
            });

            Route::namespace('CamstudioReports')->group(function () {
                Route::get('camstudio-reports/trimester/reports', 'CamstudioReportsController@trimestersReports')
                    ->name('camstudio-reports.trimester');
                Route::get('camstudio-reports/month/reports', 'CamstudioReportsController@monthsReports')
                    ->name('camstudio-reports.month');
                Route::get('camstudio-reports/manager/reports', 'CamstudioReportsController@managersReports')
                    ->name('camstudio-reports.manager');
                Route::get('camstudio-reports/manager/reports/{id}', 'CamstudioReportsController@managerReport')
                    ->name('camstudio-reports.manager.report');
            });

            Route::namespace('CamstudioReportCommentaries')->group(function () {
                Route::resource('camstudio-report-commentaries', 'CamstudioReportCommentariesController');
            });

            Route::namespace('CammodelTippers')->group(function () {
                Route::resource('cammodel-tippers', 'CammodelTippersController');
            });

            Route::namespace('CammodelTipperSocialMedias')->group(function () {
                Route::resource('cammodel-tipper-social-medias', 'CammodelTipperSocialMediasController');
            });

            Route::namespace('CammodelWorkReportCommentaries')->group(function () {
                Route::resource('cammodel-work-report-commentaries', 'CammodelWorkReportCommentariesController');
            });

            Route::namespace('Fouls')->group(function () {
                Route::resource('fouls', 'FoulsController');
            });

            Route::namespace('Rooms')->group(function () {
                Route::resource('rooms', 'RoomsController');
            });

            Route::namespace('StreamingStats')->group(function () {
                Route::resource('streaming-stats', 'StreamingStatsController');
            });

            Route::namespace('SocialStats')->group(function () {
                Route::resource('social-stats', 'SocialStatsController');
            });

            Route::namespace('CammodelPayrolls')->group(function () {
                Route::resource('cammodel-payrolls', 'CammodelPayrollsController');
                Route::get('cammodel-payroll-export/{id}', 'CammodelPayrollsController@exportCammodelPayroll')->name('export.cammodelPayroll');
                Route::get('cammodel-payroll-export-bank-transfers/{id}', 'CammodelPayrollsController@exportCammodelPayrollBankTransfers')->name('export.cammodelPayrollBankTransfers');
                Route::get('cammodel-payrolls/{id}/recalculate', 'CammodelPayrollsController@reCalculateCammodelPayroll')->name('recalculate.cammodelPayroll');
            });
        });
    });
});

/**
 * Frontend routes
 */
Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Front')->group(function () {
        Route::group(['middleware' => ['auth', 'web']], function () {
        });

        Route::group(['middleware' => ['banned.country']], function () {
            Route::get('model/{slug}', 'CamModelFrontController@getCamModel')->name('front.model.slug');
            Route::get('model/{slug}/wishlists', 'CamModelFrontController@getCamModelWishlists')->name('front.model.wishlists');
        });
    });
});
