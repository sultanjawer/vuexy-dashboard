<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function check($permission)
    {
        return Gate::allows($permission);
    }

    public function orders()
    {
        return $this->check('orders_page');
    }

    public function createOrder()
    {
        return $this->check('can_create_order');
    }

    public function updateOrder()
    {
        return $this->check('can_edit_order');
    }

    public function showOrder()
    {
        return $this->check('can_show_order');
    }

    public function changeOrderStatus()
    {
        return $this->check('can_change_order_status');
    }
}
