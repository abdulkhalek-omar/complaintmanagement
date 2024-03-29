<?php

use App\Http\Controllers\CustomerManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\TicketAssignController;
use App\Http\Controllers\TicketCloseOpenController;
use App\Http\Controllers\TicketSatisfactionController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
    Route::resource('tickets', CustomerManagementController::class);
    Route::post('tickets/store', [CustomerManagementController::class, 'store'])->name('tickets.store');

    Route::post('tickets', [TicketCloseOpenController::class, 'openTicket'])->name('tickets.openTicket');

    Route::get('tickets/closeTicket/index/{id}', [TicketCloseOpenController::class, 'index'])->name('tickets.closeTicket.index')->whereNumber('id');
    Route::post('tickets/closeTicket/store', [TicketCloseOpenController::class, 'closeTicket'])->name('tickets.closeTicket.store');


    Route::get('tickets/satisfied/index/{id}', [TicketSatisfactionController::class, 'index'])->name('tickets.satisfied.index')->whereNumber('id');
    Route::post('tickets/not-satisfied/store', [TicketSatisfactionController::class, 'store'])->name('tickets.notSatisfied.store');
    Route::post('tickets/satisfied/store', [TicketSatisfactionController::class, 'update'])->name('tickets.satisfied.update');

    Route::get('tickets/assign/index/{employee_id}/{id}', [TicketAssignController::class, 'index'])->name('tickets.assign.index')->whereNumber(['employee_id', 'id']);
    Route::post('tickets/assign/store', [TicketAssignController::class, 'store'])->name('tickets.assign.store');

    Route::resource('profile/personal-information', PersonalInformationController::class)->only(['index', 'store']);

});
