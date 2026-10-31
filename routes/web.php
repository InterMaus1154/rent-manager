<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {

    Route::get('/login', 'loginView')->name('auth.login.view');
    Route::post('/login', 'login')->name('auth.login');

    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::post('/logout', 'logout')->name('auth.logout');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::group(['prefix' => 'tenants', 'controller' => TenantController::class], function () {

        Route::get('/', 'index')->name('tenants.index');
        Route::post('/', 'store')->name('tenants.store');
    });

    Route::group(['controller' => PaymentController::class, 'prefix' => 'payments'], function () {
        Route::get('/new', 'create')->name('payments.create');
        Route::post('/', 'store')->name('payments.store');
    });

});
