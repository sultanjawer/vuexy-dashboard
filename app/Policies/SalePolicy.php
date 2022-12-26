<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class SalePolicy
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

    public function sales()
    {
        return $this->check('sales_page');
    }

    public function createSale()
    {
        return $this->check('can_create_sale');
    }

    public function updateSale()
    {
        return $this->check('can_edit_sale');
    }

    public function showSale()
    {
        return $this->check('can_show_sale');
    }

    public function changeSaleStatus()
    {
        return $this->check('can_change_sale_status');
    }
}
