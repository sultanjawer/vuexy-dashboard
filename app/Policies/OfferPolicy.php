<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class OfferPolicy
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

    public function offers()
    {
        return $this->check('offers_page');
    }

    public function createOffer()
    {
        return $this->check('can_create_offer');
    }

    public function updateOffer()
    {
        return $this->check('can_edit_offer');
    }

    public function showOffer()
    {
        return $this->check('can_show_offer');
    }

    public function changeOfferStatus()
    {
        return $this->check('can_change_offer_status');
    }
}
