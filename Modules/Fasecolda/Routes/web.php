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
            Route::namespace('FasecoldaPrices')->group(function () {
                Route::resource('fasecolda-prices', 'FasecoldaPricesController');
            });

            Route::namespace('FasecoldaCodes')->group(function () {
                Route::resource('fasecolda-codes', 'FasecoldaCodesController');
            });
        });
    });
});
