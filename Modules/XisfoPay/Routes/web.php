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
            Route::namespace('ChaseTransfers')->group(function () {
                Route::resource('chase-transfers', 'ChaseTransfersController');
            });

            Route::namespace('ChaseTransferAmounts')->group(function () {
                Route::resource('chase-transfer-amounts', 'ChaseTransferAmountsController');
            });

            Route::namespace('ContractRequestStreamAccountCommissions')->group(function () {
                Route::resource('stream-account-commissions', 'ContractRequestStreamAccountCommissionsController');
            });

            Route::namespace('PrintContracts')->group(function () {
                Route::get('print-contracts/{id}', 'PrintContractsController@generateContract')->name('contract.generate');
            });

            Route::namespace('PrintContractRequests')->group(function () {
                Route::get('print-contract-requests/{id}', 'PrintContractRequestsController@export')->name('contractRequest.generate');
            });

            Route::namespace('ChaseTransfers')->group(function () {
                Route::resource('chase-transfers', 'ChaseTransfersController');
                Route::get('chase-transfers/legalize/chase-transfers', 'ChaseTransfersController@legalizeView')->name('chaseTransfer.legalizeView');
                Route::post('chase-transfers/legalize/selected', 'ChaseTransfersController@legalize')->name('chaseTransfer.legalize');
            });

            Route::namespace('ContractStatuses')->group(function () {
                Route::resource('contract-statuses', 'ContractStatusesController');
            });

            Route::namespace('Contracts')->group(function () {
                Route::resource('contracts', 'ContractsController');
            });

            Route::namespace('ContractCommentaries')->group(function () {
                Route::resource('contract-commentaries', 'ContractCommentariesController');
            });

            Route::namespace('ContractRequestCommentaries')->group(function () {
                Route::resource('contract-request-commentaries', 'ContractRequestCommentariesController');
            });

            Route::namespace('PaymentRequestCommentaries')->group(function () {
                Route::resource('payment-request-commentaries', 'PaymentRequestCommentariesController');
            });

            Route::namespace('PaymentRequestAdvances')->group(function () {
                Route::resource('payment-request-advances', 'PaymentRequestAdvancesController');
                Route::get('remove-advance-image', 'PaymentRequestAdvancesController@removeThumbnail')->name('payment.advance.remove.thumb');
            });

            Route::namespace('ContractRenewals')->group(function () {
                Route::resource('contract-renewals', 'ContractRenewalsController');
            });

            Route::namespace('ContractRequests')->group(function () {
                Route::resource('contract-requests', 'ContractRequestsController');
                Route::get('new-contract-request/{customer}', 'ContractRequestsController@createNew')->name('customer-new-contract-request');
                Route::post('store-customer-contract-request/{customer}', 'ContractRequestsController@storeNew')->name('store-customer-new-contract-request');
            });

            Route::namespace('ContractRequestStatuses')->group(function () {
                Route::resource('contract-request-statuses', 'ContractRequestStatusesController');
            });

            Route::namespace('PaymentRequestStatuses')->group(function () {
                Route::resource('payment-request-statuses', 'PaymentRequestStatusesController');
            });

            Route::namespace('PaymentRequests')->group(function () {
                Route::resource('payment-requests', 'PaymentRequestsController');
                Route::get('remove-payment-thumb', 'PaymentRequestsController@removeThumbnail')->name('payment.remove.thumb');
                Route::put('payment-requests/add-to/payment-cut/', 'PaymentRequestsController@addPaymentRequestToCut')->name('addPaymentRequestToCut');
                Route::get('payment-requests/pending/to-approve', 'PaymentRequestsController@pendingPaymentRequests')->name('pendingPaymentRequests');
                Route::post('payment-requests/approve/to-approve', 'PaymentRequestsController@approvePaymentRequests')->name('approvePaymentRequests');
            });

            Route::namespace('PaymentCuts')->group(function () {
                Route::resource('payment-cuts', 'PaymentCutsController');
                Route::get('payment-cut-export/{id}', 'PaymentCutsController@exportPaymentCut')->name('export.paymentCut');
                Route::get('payment-cut-export-bank-transfers/{id}', 'PaymentCutsController@exportPaymentCutBankTransfers')->name('export.paymentCutBankTransfers');
                Route::get('payment-cuts/{id}/recalculate', 'PaymentCutsController@reCalculatePaymentCut')->name('recalculate.paymentCut');
            });

            Route::namespace('ContractRequestStatusesLogs')->group(function () {
                Route::resource('contract-request-statuses-logs', 'ContractRequestStatusesLogsController');
            });

            Route::namespace('PaymentRequestStatusesLogs')->group(function () {
                Route::resource('payment-request-statuses-logs', 'PaymentRequestStatusesLogsController');
            });

            Route::namespace('PaymentBankTransfers')->group(function () {
                Route::resource('payment-bank-transfers', 'PaymentBankTransfersController');
                Route::post('register-token-advance-transfer', 'PaymentBankTransfersController@registerTokenAdvanceTransfer')->name('register.token.advance.transfer');
                Route::get('payment-bank-transfers-to-confirm', 'PaymentBankTransfersController@listToConfirm')->name('payment-bank-transfers.to-confirm');
                Route::post('payment-bank-tranfers-confirm-transfers', 'PaymentBankTransfersController@confirmTransfers')->name('payment-bank-transfers.confirm-transfers');
            });

            Route::namespace('ContractStatusesLogs')->group(function () {
                Route::resource('contract-statuses-logs', 'ContractStatusesLogsController');
            });

            Route::namespace('ContractRates')->group(function () {
                Route::resource('contract-rates', 'ContractRatesController');
            });

            Route::namespace('XisfoServices')->group(function () {
                Route::resource('xisfo-services', 'XisfoServicesController');
            });

            Route::namespace('XisfoAppointments')->group(function () {
                Route::resource('xisfo-appointments', 'XisfoAppointmentsController');
            });

            Route::namespace('ContractRequestStreamAccounts')->group(function () {
                Route::resource('contract-request-stream-accounts', 'ContractRequestStreamAccountsController');
            });

            Route::namespace('ChaseTransferTrms')->group(function () {
                Route::resource('chase-transfer-trms', 'ChaseTransferTrmsController');
            });

            Route::namespace('XisfoSchedulers')->group(function () {
                Route::resource('xisfo-schedulers', 'XisfoSchedulersController');
                Route::post('xisfo-schedulers/verifyService', 'XisfoSchedulersController@verifyService')->name('xisfo-schedulers.verifyService');
            });
        });
    });
});

/**
 * Frontend routes
 */
Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Front')->group(function () {
        Route::namespace('ContractRequests')->group(function () {
            Route::resource('contract-requests', 'ContractRequestsFrontController', ['only' => ['create', 'store']]);
        });

        Route::namespace('Pricing')->group(function () {
            Route::group(['middleware' => ['pricing_commercial']], function () {
                Route::get('pricing/commercial/calculator', 'PricingController@commercialPricingCalculator')->name('commercialPricingCalculator');
            });
        });

    });
});


Route::group(['prefix' => 'account', 'middleware' => ['auth', 'web'], 'as' => 'account.'], function () {
    Route::middleware(['throttle:customer_account'])->group(function () {
        Route::namespace('Front')->group(function () {
            Route::namespace('Accounts')->group(function () {
                Route::get('dashboard', 'AccountController@index')->name('dashboard');
            });

            Route::namespace('Contracts')->group(function () {
                Route::resource('contracts', 'ContractsFrontController');
            });

            Route::namespace('PaymentRequests')->group(function () {
                Route::resource('payment-requests', 'PaymentRequestsFrontController');
            });

            Route::namespace('ContractRequests')->group(function () {
                Route::resource('contract-requests', 'ContractRequestsFrontController', ['except' => ['create', 'store']]);
                Route::get('new-contract-request', 'ContractRequestsFrontController@createNew')->name('create-new-contract-request');
                Route::post('store-contract-request', 'ContractRequestsFrontController@storeNew')->name('store-new-contract-request');
            });

            Route::namespace('PaymentRequestAdvances')->group(function () {
                Route::resource('payment-request-advances', 'PaymentRequestAdvancesFrontController');
            });

            Route::namespace('PaymentBankTransfers')->group(function () {
                Route::resource('payment-bank-transfers', 'PaymentBankTransfersFrontController');
            });

            Route::namespace('PrintContracts')->group(function () {
                Route::get('print-contracts/{id}', 'PrintContractsFrontController@generateContract')->name('contract.generate');
            });

            Route::namespace('ContractRenewals')->group(function () {
                Route::resource('contract-renewals', 'ContractRenewalsFrontController');
            });


            Route::namespace('PrintContractRequests')->group(function () {
                Route::get('print-contract-requests/{id}', 'PrintContractRequestsFrontController@export')->name('contract-request.generate');
            });

            Route::namespace('ContractRequestStreamAccounts')->group(function () {
                Route::resource('contract-request-stream-accounts', 'ContractRequestStreamAccountsFrontController');
            });
        });
    });
});
