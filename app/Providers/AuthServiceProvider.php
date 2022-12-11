<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Branch;
use App\Models\City;
use App\Models\Customer;
use App\Models\Mediator;
use App\Models\Neighborhood;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use App\Policies\BranchPolicy;
use App\Policies\CityPolicy;
use App\Policies\CreateUserPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\MediatorPolicy;
use App\Policies\NeighborhoodPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        City::class => CityPolicy::class,
        Neighborhood::class => NeighborhoodPolicy::class,
        Customer::class => CustomerPolicy::class,
        Mediator::class => MediatorPolicy::class,
        Order::class => OrderPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Branch::class => BranchPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
