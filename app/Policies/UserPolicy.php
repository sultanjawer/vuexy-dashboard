<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
    }

    public function check($permission)
    {
        return Gate::allows($permission);
    }

    public function users()
    {
        return $this->check('users_page');
    }

    public function showUser()
    {
        return $this->check('can_show_user');
    }

    public function createUser()
    {
        return $this->check('can_create_user');
    }

    public function updateUser()
    {
        return $this->check('can_edit_user');
    }

    public function changeUserStatus()
    {
        return $this->check('can_change_user_status');
    }

    public function sms()
    {
        return $this->check('sms_page');
    }

    public function sms_send_individual()
    {
        return $this->check('send_individual_messages');
    }


    public function sms_send_collection()
    {
        return $this->check('send_collection_messages');
    }
}
