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
        // Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
        Route::namespace('Admin')->group(function () {
            Route::namespace('Countries')->group(function () {
                Route::resource('countries', 'CountryController');
                Route::get('/api/getCountry/{id}/province', 'CountryController@getCountry')->name('country.getAdminCountry');
            });

            Route::namespace('Provinces')->group(function () {
                Route::get('/api/getProvince/{id}/city', 'ProvinceController@getProvince')->name('checkout.getAdminProvince');
            });

            Route::resource('countries.provinces', 'Provinces\ProvinceController');
            Route::resource('countries.provinces.cities', 'Cities\CityController');

            Route::namespace('Schedulers')->group(function () {
                Route::get('admin/schedulers/viewScheduler/{id}', 'SchedulersController@viewScheduler');
                Route::post('admin/schedulers/createEventHandler', 'SchedulersController@createEventHandler')->name('admin.schedulers.createEventHandler');
                Route::post('admin/schedulers/getEventHandler', 'SchedulersController@getEventHandler')->name('admin.schedulers.getEventHandler');
                Route::post('admin/schedulers/getWorkingHour', 'SchedulersController@getWorkingHour')->name('admin.schedulers.getWorkingHour');
                Route::post('admin/schedulers/deleteEventHandler', 'SchedulersController@deleteEventHandler')->name('admin.schedulers.deleteEventHandler');
            });
        });
    });
});

/**
 * Front routes
 */
/**
 * Auth routes
 */
Route::namespace('Auth')->group(function () {
    Route::middleware(['throttle:global'])->group(function () {
        Route::namespace('PasswordResets')->group(function () {
            Route::post('reset/password/{token}', 'PasswordResetController@passwordReset')->name('reset.password.generals');
            Route::get('password/reset/{token}', 'PasswordResetController@showResetForm')->name('password.reset.generals');
        });
    });
});

Route::namespace('Admin')->group(function () {
    Route::namespace('Countries')->group(function () {
        Route::get('/api/user/getCountry/{id}/province', 'CountryController@getCountry')->name('country.getFrontCountry');
    });
    Route::namespace('Provinces')->group(function () {
        Route::get('/api/user/getProvince/{id}/city', 'ProvinceController@getProvince')->name('checkout.getFrontProvince');
    });
});
