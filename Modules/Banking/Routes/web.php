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
            Route::namespace('Banks')->group(function () {
                Route::resource('banks', 'BankController');
            });
            Route::namespace('BankMovements')->group(function () {
                Route::resource('bank-movements', 'BankMovementsController');
            });

            Route::namespace('BankAccounts')->group(function () {
                Route::resource('bank-accounts', 'BankAccountsController');
            });
        });
    });
});
