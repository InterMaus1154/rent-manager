<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function(){

    Route::get('/login', 'loginView')->name('auth.login.view');
    Route::post('/login', 'login')->name('auth.login');

    Route::middleware(AuthMiddleware::class)->group(function(){
       Route::post('/logout', 'logout')->name('auth.logout');
    });
});
