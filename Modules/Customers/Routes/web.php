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
            Route::namespace('Customers')->group(function () {
                Route::resource('customers', 'CustomerController');
                Route::resource('customer-statuses', 'CustomerStatusController');
                Route::put('/customer/updateForBlade', 'CustomerController@updateForBlade')->name('customers.updateForBlade');
                Route::put('/customer/updatePassword/{id}', 'CustomerController@updatePassword')->name('customers.updatePassword');
                Route::get('/api/customers', 'CustomerController@list');
                Route::get('/api/customers/{id}', 'CustomerController@getCustomer');
                Route::get('/api/listEconomicActivity', 'CustomerController@getlistEconomicActivity');
                Route::get('/api/listCities', 'CustomerController@getListCities');
                Route::get('/api/listRelationships', 'CustomerController@getRelationships');
                Route::get('/api/listCivilStatuses', 'CustomerController@getCivilStatuses');
                Route::get('/api/listGenres', 'CustomerController@getGenres');
                Route::get('/api/listScholarities', 'CustomerController@getScholarities');
                Route::get('/api/listProfessions', 'CustomerController@getProfessions');
                Route::get('/api/listVehicles', 'CustomerController@getVehicles');
                Route::get('/api/listIdentityTypes', 'CustomerController@getIdentityTypes');
                Route::get('/api/listHousings', 'CustomerController@getHousings');
                Route::get('/api/listStratums', 'CustomerController@getStratums');
                Route::get('/api/listEps', 'CustomerController@getEps');
            });

            Route::namespace('CustomerAddresses')->group(function () {
                Route::resource('customer-addresses', 'CustomerAddressController');
            });

            Route::namespace('Leads')->group(function () {
                Route::resource('leads', 'LeadsController');
            });

            Route::namespace('LeadStatuses')->group(function () {
                Route::resource('lead-statuses', 'LeadStatusesController');
            });

            Route::namespace('LeadReasons')->group(function () {
                Route::resource('lead-reasons', 'LeadReasonsController');
            });

            Route::namespace('LeadCommentaries')->group(function () {
                Route::resource('lead-commentaries', 'LeadCommentariesController');
            });

            Route::namespace('CustomerIdentities')->group(function () {
                Route::resource('customer-identities', 'CustomerIdentityController');
            });

            Route::namespace('CustomerPhones')->group(function () {
                Route::resource('customer-phones', 'CustomerPhonesController');
            });

            Route::namespace('CustomerEpss')->group(function () {
                Route::resource('customer-epss', 'CustomerEpsController');
            });

            Route::namespace('CustomerReferences')->group(function () {
                Route::resource('customer-references', 'CustomerReferenceController');
            });

            Route::namespace('CustomerEconomicActivities')->group(function () {
                Route::resource('customer-economic-activities', 'CustomerEconomicActivityController');
            });

            Route::namespace('CustomerCompanies')->group(function () {
                Route::resource('customer-companies', 'CustomerCompaniesController');
                Route::post('/update-logo/{id}', 'CustomerCompaniesController@updateLogo')->name('update_logo');
            });

            Route::namespace('CustomerBankAccounts')->group(function () {
                Route::resource('customer-bank-accounts', 'CustomerBankAccountsController');
            });

            Route::namespace('CustomerProfessions')->group(function () {
                Route::resource('customer-professions', 'CustomerProfessionController');
            });

            Route::namespace('CustomerVehicles')->group(function () {
                Route::resource('customer-vehicles', 'CustomerVehicleController');
            });

            Route::namespace('CustomerEmails')->group(function () {
                Route::resource('customer-emails', 'CustomerEmailController');
            });

            Route::namespace('CustomerCommentaries')->group(function () {
                Route::resource('customer-commentaries', 'CustomerCommentaryController');
            });

            Route::namespace('NewsletterSubscriptions')->group(function () {
                Route::resource('newsletter-subscription', 'NewsletterSubscriptionController');
            });
        });
    });
});

/**
 * Frontend routes
 */
Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Front')->group(function () {
        Route::namespace('NewsletterSubscriptions')->group(function () {
            Route::resource('newsletter-subscription', 'NewsletterSubscriptionFrontController');
        });

        Route::namespace('Leads')->group(function () {
            Route::resource('leads', 'LeadsFrontController');
        });

        Route::group(['prefix' => 'account', 'middleware' => ['auth', 'web'], 'as' => 'account.'], function () {
            Route::middleware(['throttle:customer_account'])->group(function () {
                Route::namespace('CustomerAddresses')->group(function () {
                    Route::resource('customer-addresses', 'CustomerAddressFrontController');
                });

                Route::namespace('CustomerPhones')->group(function () {
                    Route::resource('customer-phones', 'CustomerPhonesFrontController');
                });

                Route::namespace('CustomerEmails')->group(function () {
                    Route::resource('customer-emails', 'CustomerEmailFrontController');
                });

                Route::namespace('CustomerReferences')->group(function () {
                    Route::resource('customer-references', 'CustomerReferenceFrontController');
                });

                Route::namespace('CustomerBankAccounts')->group(function () {
                    Route::resource('customer-bank-accounts', 'CustomerBankAccountsFrontController');
                });

                Route::namespace('CustomerCompanies')->group(function () {
                    Route::resource('customer-companies', 'CustomerCompaniesFrontController');
                    Route::post('/update_logo/{id}', 'CustomerCompaniesFrontController@updateLogo')->name('customer-companies.update_logo');
                });

                Route::namespace('CustomerIdentities')->group(function () {
                    Route::resource('customer-identities', 'CustomerIdentityFrontController');
                });

                Route::namespace('CustomerReferences')->group(function () {
                    Route::resource('customer-references', 'CustomerReferenceFrontController');
                });
            });
        });
    });
});
