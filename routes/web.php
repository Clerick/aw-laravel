<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('loginpage');
    })->name(config('routes.loginpage'));

    Route::post('/login', [AuthController::class, 'login'])->name(config('routes.auth.login'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name(config('routes.dashboard'));
    Route::get('/logout', [AuthController::class, 'logout'])->name(config('routes.auth.logout'));

    Route::post('/sendticket', [TicketController::class, 'submit'])->name(config('routes.submit.ticket'));

   
});