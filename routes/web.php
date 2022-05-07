<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\UpdateProfileLoginInformationForm;
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

//        Route::get('/showUsers', [EmployeeController::class, 'showUsers']);
//        Route::get('/showUser', [EmployeeController::class, 'showUser']);

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
    Route::resource('tickets', TicketController::class);
});
