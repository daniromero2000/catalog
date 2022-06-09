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
        Route::namespace('Pqrs')->group(function () {
            Route::resource('pqrs', 'PqrController');
            Route::resource('pqr-statuses', 'PqrStatusController');
            Route::get('pqrsdashboard', 'PqrsDashboardController@index')->name('pqrsdashboard');
        });
        Route::resource('pqrCommentaries', 'PqrCommentaries\PqrCommentaryController');
    });
});


/**
 * Frontend routes
 */
Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Front')->group(function () {
        Route::group(['prefix' => 'front'], function () {
            Route::namespace('Pqrs')->group(function () {
                Route::resource('pqrs', 'PqrController');
            });
        });
    });

    Route::namespace('Front')->group(function () {
        Route::namespace('Pqrs')->group(function () {
        });
    });
});
