<?php

use App\Http\Controllers\AdminPanel\HomeController;
use App\Models\Branch;
use App\Models\City;
use App\Models\Customer;
use App\Models\Mediator;
use App\Models\Neighborhood;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use mikehaertl\pdftk\Pdf;

Route::controller(HomeController::class)
    ->prefix('panel')
    ->as('panel.')
    ->middleware(['web', 'auth', 'active'])
    ->group(
        function () {
            #Pages
            Route::get('/neighborhoods', 'neighborhoods')->name('neighborhoods')->can('neighborhoods', Neighborhood::class);
            Route::get('/reservations', 'reservations')->name('reservations')->can('reservations', Reservation::class);
            Route::get('/create-user', 'createUser')->name('create.user')->can('createUser', User::class);
            Route::get('/customers', 'customers')->name('customers')->can('customers', Customer::class);
            Route::get('/mediators', 'mediators')->name('mediators')->can('mediators', Mediator::class);
            Route::get('/branches', 'branches')->name('branches')->can('branches', Branch::class);
            Route::get('/order/{order}', 'order')->name('order')->can('showOrder', Order::class);
            Route::get('/new-user', 'newUser')->name('new.user')->withoutMiddleware('active');
            Route::get('/orders', 'orders')->name('orders')->can('orders', Order::class);
            Route::get('/cities', 'cities')->name('cities')->can('cities', City::class);
            Route::post('/update-password', 'updatePassword')->name('update.password');
            Route::get('/orders-marketer', 'ordersMarketer')->name('orders.marketer');
            Route::get('/change-password', 'changePassword')->name('change.password');
            Route::get('/users', 'users')->name('users')->can('users', User::class);
            Route::get('/update-user/{user}', 'updateUser')->name('update.user');
            Route::get('/sms', 'sms')->name('sms')->can('sms', User::class);
            Route::get('/create-user', 'createUser')->name('create.user');
            Route::get('/edit-user', 'editUser')->name('edit.user');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/user/{user}', 'user')->name('user');
            Route::get('/home', 'home')->name('home');
            Route::get('/offers', 'offers')->name('offers')->can('offers', Offer::class);
            Route::get('/offer/{offer}', 'offer')->name('offer')->can('showOffer', Offer::class);
            Route::get('/create-offer', 'createOffer')->name('create.offer')->can('createOffer', Offer::class);
            Route::get('/update-offer/{offer}', 'updateOffer')->name('update.offer')->can('updateOffer', Offer::class);

            Route::get('/sales', 'sales')->name('sales')->can('sales', Sale::class);
            Route::get('/sale/{sale}', 'sale')->name('sale')->can('showSale', Sale::class);
            Route::get('/create-sale/{offer}', 'createSale')->name('create.sale')->can('createSale', sale::class);
            Route::get('/update-sale/{sale}', 'updateSale')->name('update.sale')->can('updateSale', sale::class);
        }
    );
