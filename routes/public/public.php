<?php

use App\Http\Controllers\AdminPanel\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)
    ->prefix('')
    ->as('')
    ->middleware(['web',])
    ->group(function () {
        Route::get('/forget-password', 'forgetPassword')->name('forget.password');
        Route::post('/check-forget-password', 'checkForgetPassword')->name('check.forget.password');
        Route::post('/reset-password', 'resetPassword')->name('reset.password');
        Route::get('/page-reset-password/{user_id}', 'pageResetPassword')->name('page.reset.password');
        Route::get('/customer-order/usr-{user_id}', 'customerOrder')->name('customer.order');
    });
