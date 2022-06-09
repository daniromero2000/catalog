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
use Modules\Companies\Events\Test;

/*
 * Admin routes
 */

Route::middleware(['throttle:global'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::get('admin/loginform', 'LoginController@showLoginForm')->name('admin.loginform');
        Route::post('admin/login', 'LoginController@login')->name('admin.login');
        Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
    });


    Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
        Route::namespace('Admin')->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::middleware(['throttle:admin'])->group(function () {
                Route::get('/redirectAction/{action}/', 'DashboardController@redirectAction')->name('redirectAction');

                Route::namespace('Subsidiaries')->group(function () {
                    Route::resource('subsidiaries', 'SubsidiaryController');
                });

                Route::get('/broadcast', function () {
                    broadcast(new Test(["data" => "Prueba"]));
                });

                Route::namespace('Notifications')->group(function () {
                    Route::get('getNotifications', 'NotificationController@list');
                    Route::post('saveNotification', 'NotificationController@store');
                    Route::post('deleteNotification/{id}', 'NotificationController@destroy');
                });

                Route::namespace('EmployeeEmails')->group(function () {
                    Route::resource('employee-emails', 'EmployeeEmailController');
                });

                Route::namespace('Interviews')->group(function () {
                    Route::resource('interviews', 'InterviewsController');
                });

                Route::namespace('InterviewStatuses')->group(function () {
                    Route::resource('interview-statuses', 'InterviewStatusesController');
                });

                Route::namespace('InterviewCommentaries')->group(function () {
                    Route::resource('interview-commentaries', 'InterviewCommentariesController');
                });

                Route::namespace('EmployeePhones')->group(function () {
                    Route::resource('employee-phones', 'EmployeePhoneController');
                });

                Route::namespace('EmployeeWorkingHours')->group(function () {
                    Route::resource('employee-working-hours', 'EmployeeWorkingHoursController');
                });

                Route::namespace('EmployeeIdentities')->group(function () {
                    Route::resource('employee-identities', 'EmployeeIdentityController');
                });

                Route::namespace('EmployeeAddresses')->group(function () {
                    Route::resource('employee-addresses', 'EmployeeAddressController');
                });

                Route::namespace('EmployeeEmergencyContacts')->group(function () {
                    Route::resource('employee-emergency-contacts', 'EmployeeEmergencyContactController');
                });

                Route::namespace('EmployeeEpss')->group(function () {
                    Route::resource('employee-epss', 'EmployeeEpsController');
                });

                Route::namespace('EmployeeProfessions')->group(function () {
                    Route::resource('employee-professions', 'EmployeeProfessionController');
                });

                Route::namespace('Companies')->group(function () {
                    Route::resource('companies', 'CompanyController');
                });

                Route::namespace('CorporatePhones')->group(function () {
                    Route::resource('corporate-phones', 'CorporatePhonesController');
                });

                Route::namespace('EmployeesProfiles')->group(function () {
                    Route::resource('employees-profiles', 'EmployeesProfilesController');
                });

                Route::namespace('Kpis')->group(function () {
                    Route::resource('kpis', 'KpisController');
                });

                Route::namespace('Shifts')->group(function () {
                    Route::resource('shifts', 'ShiftsController');
                });

                Route::namespace('Goals')->group(function () {
                    Route::resource('goals', 'GoalsController');
                });

                Route::resource('employees', 'EmployeeController');

                Route::group(['middleware' => ['role:superadmin, guard:employee']], function () {
                    Route::namespace('Roles')->group(function () {
                        Route::resource('roles', 'RoleController');
                    });

                    Route::namespace('Permissions')->group(function () {
                        Route::resource('permissions', 'PermissionController');
                    });

                    Route::namespace('Actions')->group(function () {
                        Route::resource('actions', 'ActionController');
                    });
                });
                Route::namespace('EmployeeCommentaries')->group(function () {
                    Route::resource('employee-commentaries', 'EmployeeCommentaryController');
                });
            });
        });
    });
});

/*
 * Frontend routes
 */
