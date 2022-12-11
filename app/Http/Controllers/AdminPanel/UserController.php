<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changeUserStatus(User $user)
    {
        if ($user->user_status == 'active') {
            $user->update(['user_status' => 'inactive']);
        } elseif ($user->user_status == 'inactive') {
            $user->update(['user_status' => 'active']);
        }

        return redirect()->route('panel.users')->with('message',  '👍 تم تحديث حالة المستخدم بنجاح',);
    }
}
