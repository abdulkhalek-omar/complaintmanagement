<?php

use App\Http\Controllers\CustomerManagementController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LanguageController@switchLang']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {

//        Route::get('/showUsers', [EmployeeController::class, 'showUsers']);
//        Route::get('/showUser', [EmployeeController::class, 'showUser']);

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
    Route::resource('tickets', CustomerManagementController::class);
    Route::post('tickets/store', [CustomerManagementController::class, 'store'])->name('tickets.store');
    Route::post('tickets', [CustomerManagementController::class, 'closeOpenTicket'])->name('tickets.close-open-ticket');
    Route::post('tickets/satisfied/store', [CustomerManagementController::class, 'storeSatisfied'])->name('tickets.satisfied.store');
    Route::get('tickets/satisfied/index/{id}', [CustomerManagementController::class, 'indexSatisfied'])->name('tickets.satisfied.index');
    Route::resource('profile/personal-information', PersonalInformationController::class)->only(['index', 'store']);
});
