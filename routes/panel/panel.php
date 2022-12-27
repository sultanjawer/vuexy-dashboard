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

                // $data = [
                //     'sale_code' => 'QTF-1-USR1',
                //     'customer_name' => 'amrakram',
                //     'sale_create_at' => '01-02-2022',
                //     'city_name' => 'gaza',

                //     #First Customer
                //     'customer_buyer_adj' => 'buyer',
                //     'customer_buyer_name' => 'amrakram',
                //     'customer_buyer_id_type' => 'private',
                //     'customer_buyer_nationality' => 'palestinian',
                //     'customer_buyer_phone' => '0599916672',
                //     'customer_buyer_city_name' => 'gaza',
                //     'customer_buyer_building_number' => '2139539',
                //     'customer_buyer_street_name' => 'jamal abd al nasser',
                //     'customer_buyer_additional_number' => '2124567',
                //     'customer_buyer_zip_code' => '23456',
                //     'customer_buyer_email' => 'amro@gmail.com',

                //     #Second Customer
                //     'customer_seller_adj' => 'seller',
                //     'customer_seller_name' => 'amrakram',
                //     'customer_seller_id_type' => 'private',
                //     'customer_seller_nationality' => 'palestinian',
                //     'customer_seller_phone' => '0599916672',
                //     'customer_seller_city_name' => 'gaza',
                //     'customer_seller_building_number' => '2139539',
                //     'customer_seller_street_name' => 'jamal abd al nasser',
                //     'customer_seller_additional_number' => '2124567',
                //     'customer_seller_zip_code' => '23456',
                //     'customer_seller_email' => 'amro@gmail.com',

                //     #Real Estate Information
                //     'real_estate_statement' => 'ok good way',
                //     'real_estate_space' => '2345',
                //     'real_estate_location' => 'palestine/ gaza',
                //     'total_price' => '345',
                //     'total_price_text' => 'الف واربعة مئة دولار امريكي',
                //     'paid_amount' => '45678',
                //     'date_expire' => '01-02-2022',
                //     'amount_due' => '87654',
                //     'days' => '365',
                //     'customer_buyer_name' => 'proamrakram',
                //     'customer_seller_name' => 'amrakram',
                // ];

                $original_pdf = public_path() . '/pdfs/testing.pdf';

                $pdf = new Pdf(
                    $original_pdf,
                    [
                        'locale' => 'ar_SA.utf8',
                        'procEnv' => [
                            'LANG' => 'ar_SA.UTF-8',
                        ],
                    ]
                );

                $result = $pdf->fillForm([
                    'testthis' => 'اللغة العربية الان مدعومة',
                ])->needAppearances()
                    ->replacementFont('/usr/share/fonts/dejavu/DejaVuSans.ttf')
                    ->saveAs(public_path() . '/NoWay.pdf');

                $error = '';

                if ($result === false) {
                    $error = $pdf->getError();
                }

                return Response::download(public_path('NoWay.pdf'), 'NoWay.pdf', ['Content-Type: application/pdf']);
            });
        }
    );
