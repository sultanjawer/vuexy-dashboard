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


            Route::get('pdf', function () {

                $data = [
                    'sale_created_at' => '01-01-2023',
                    'sale_code' => 'QTF-1-USR1',
                    'customer_name' => 'عمرو اكرم',
                    'sale_create_at' => '01-02-2022',
                    'city_name' => 'غزة',

                    #First Customer
                    'customer_buyer_adj' => 'عمرو المشتري',
                    'customer_buyer_name' => 'اسم عمرو المشتري',
                    'customer_buyer_id_type' => 'عمل خاص',
                    'customer_buyer_id_number' => 405235530,
                    'customer_buyer_nationality' => 'فلسطيني',
                    'customer_buyer_phone' => '0599916672',
                    'customer_buyer_city_name' => 'غزة',
                    'customer_buyer_building_number' => '2139539',
                    'customer_buyer_street_name' => 'شارع جمال عبد الناصر',
                    'customer_buyer_additional_number' => '2124567',
                    'customer_buyer_zip_code' => '23456yo',
                    'customer_buyer_email' => 'amro@gmail.com',

                    #Second Customer
                    'customer_seller_adj' => 'عمرو البائع',
                    'customer_seller_name' => 'اسم عمرو البائع',
                    'customer_seller_id_type' => 'عمر خاص',
                    'customer_seller_id_number' => 405235530,
                    'customer_seller_nationality' => 'فلسطيني',
                    'customer_seller_phone' => '0599916672',
                    'customer_seller_city_name' => 'غزة',
                    'customer_seller_building_number' => '2139539',
                    'customer_seller_street_name' => 'شارع جمال عبد الناصر',
                    'customer_seller_additional_number' => '2124567',
                    'customer_seller_zip_code' => '23456',
                    'customer_seller_email' => 'amro@gmail.com',

                    #Real Estate Information
                    'real_estate_statement' => 'تمام تمت العملية بنجاح',
                    'real_estate_space' => '2345',
                    'real_estate_location' => 'فلسطين / غزة',
                    'total_price' => '345',
                    'total_price_text' => 'الف واربعة مئة دولار امريكي',
                    'paid_amount' => '45678',
                    'date_expire' => '01-02-2022',
                    'amount_due' => '87654',
                    'days' => '365',
                    'customer_buyer_name' => 'المبرمج عمرو اكرم',
                    'customer_seller_name' => 'مع تحياتي المبرمج عمرو اكرم  من فلسطين',
                ];

                $original_pdf = public_path() . '/pdfs/reservation-contract-v3.pdf';

                $pdf = new Pdf($original_pdf);

                $font = public_path('/pdfs/fonts/times_new_roman_bold.ttf');

                $result = $pdf->fillForm($data)
                    ->needAppearances()
                    ->replacementFont($font)
                    ->saveAs(public_path() . '/reservation-contract-v3.pdf');

                $error = '';

                if ($result === false) {
                    $error = $pdf->getError();
                }

                return Response::download(public_path('reservation-contract-v3.pdf'), 'reservation-contract-v3.pdf', ['Content-Type: application/pdf']);
            });
        }
    );
