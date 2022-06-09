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
            Route::namespace('PawnItemStatuses')->group(function () {
                Route::resource('pawn-item-statuses', 'PawnItemStatusesController');
            });

            Route::namespace('PawnItemCategories')->group(function () {
                Route::resource('pawn-item-categories', 'PawnItemCategoriesController');
            });

            Route::namespace('JewelryQualities')->group(function () {
                Route::resource('jewelry-qualities', 'JewelryQualitiesController');
            });

            Route::namespace('PawnItems')->group(function () {
                Route::resource('pawn-items', 'PawnItemsController');
            });

            Route::namespace('FasecoldaPriceRates')->group(function () {
                Route::resource('fasecolda-price-rates', 'FasecoldaPriceRatesController');
            });

            Route::namespace('PawnShopSelfAssessor')->group(function () {
                Route::get('/autoevaluador/getmarcs/', 'PawnShopSelfAssessorController@getBrands');
                Route::get('/autoevaluador/getrefs1/', 'PawnShopSelfAssessorController@getReferences1');
                Route::get('/autoevaluador/getrefs2/', 'PawnShopSelfAssessorController@getReferences2');
                Route::get('/autoevaluador/getrefs3/', 'PawnShopSelfAssessorController@getReferences3');
                Route::get('/autoevaluador/getcode/', 'PawnShopSelfAssessorController@getFasecoldaYearModels');
                Route::get('/autoevaluador/getprice/', 'PawnShopSelfAssessorController@getFasecoldaPrice');
                Route::get('/autoevaluador/getjewelryprice', 'PawnShopSelfAssessorController@getjewelryprice');
                Route::resource('pawn-shop-self-assessor', 'PawnShopSelfAssessorController');
            });
        });
    });
});



/**
 * Frontend routes
 */
Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Items')->group(function () {
        Route::get('/items/getmarcs/', 'ItemController@findMarcaWithClase');
        Route::get('/items/getrefs1/', 'ItemController@findref1WithMarca');
        Route::get('/items/getrefs2/', 'ItemController@findref2Withref1');
        Route::get('/items/getrefs3/', 'ItemController@findref3Withref2');
        Route::get('/items/getcode/', 'ItemController@findcodeWithref23');
        Route::get('/items/getprice/', 'ItemController@findFasecoldaPrice');
        Route::resource('items', 'ItemController');
    });
});
