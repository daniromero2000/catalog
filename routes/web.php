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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/**
 * Frontend routes
 */
Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('logout', 'LoginController@logout');
});



Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');

     Route::get('/terminos-y-condiciones', function () {
        return view('layouts.front.information.terms_and_conditions');
    })->name('termsAndConditions');

    Route::get('/nuestra-empresa', function () {
        return view('layouts.front.information.our_company');
    })->name('ourCompany');

    Route::get('/metodos-de-pago', function () {
        return view('layouts.front.information.payment_methods');
    })->name('paymentMethods');

    Route::get('/metodo-de-entrega', function () {
        return view('layouts.front.information.method_of_delivery');
    })->name('methodOfDelivery');

    Route::get('/certificaciones', function () {
        return view('layouts.front.information.certifications');
    })->name('certifications');

    Route::get('/politica-de-devolucion', function () {
        return view('layouts.front.information.return_policy');
    })->name('returnPolicy');
});
