<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function changePassword()
    {
        $user = User::find(auth()->id());

        $check = Hash::check($this->request->old_password, $user->password);


        if (($this->request->new_password != $this->request->confirm_new_password) && !$check) {
            return redirect()->back()
                ->with('old_password', 'يرجى إدخال كلمة المرور الصحيحة')
                ->with('confirm_new_password', 'كلمة المرور غير متطابقة')
                ->with('new_password', 'كلمة المرور غير متطابقة');
        }

        if ($this->request->new_password != $this->request->confirm_new_password) {
            return redirect()->back()
                ->with('confirm_new_password', 'كلمة المرور غير متطابقة')
                ->with('new_password', 'كلمة المرور غير متطابقة');
        }

        if (!$check) {
            return redirect()->back()->with('old_password', 'يرجى إدخال كلمة المرور الصحيحة');
        }


        $user->update([
            'password' => Hash::make($this->request->new_password)
        ]);

        return redirect()->back()->with('message', 'تم تغيير كلمة المرور بنجاح');
    }

    public function resetPassword()
    {
        $user = User::find($this->request->user_id);

        if ($user) {
            $check = Hash::check($this->request->reset_password_new, $user->password);

            if (!$check) {
                if ($this->request->reset_password_new != $this->request->reset_password_confirm) {
                    return redirect()->route('page.reset.password', $user->id)
                        ->with('reset_password_new', 'كلمة المرور غير متطابقة')
                        ->with('reset_password_confirm', 'كلمة المرور غير متطابقة');
                }

                $user->update([
                    'password' => Hash::make($this->request->reset_password_new)
                ]);

                return redirect()->route('login')->with('message', 'تم تحديث كلمة المرور بنجاح');
            }

            return redirect()->route('page.reset.password', $user->id)->with('reset_password_new', 'كلمة المرور مستخدمة سابقا!!');
        }
    }

    public function store($data, $code = null)
    {
        if ($data['user_status']) {
            $user_status = 'active';
        } else {
            $user_status = 'inactive';
        }

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_status' => $user_status,
            'user_type' => $data['user_type'],
            'verification_code' => $code,
            'email_verified_at' => now(),
            'can_recieve_sms' => 0,
            'advertiser_number' => $data['advertiser_number'],
        ]);

        UserSettings::create([
            'user_id' => $user->id,
            'website_mode' => ''
        ]);

        $permissions = $data['group_permissions'];
        $this->setPermissions($user, $permissions);

        $user = User::find($user->id);

        foreach ($data['branches_ids'] ?? [] as $branch_id) {
            if (!$user->branches->contains($branch_id)) {
                $user->branches()->attach($branch_id);
            }
        }

        return User::find($user->id);
    }

    public function update($user, $data)
    {
        if ($data['user_status']) {
            $user_status = 'active';
        } else {
            $user_status = 'inactive';
        }

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'user_status' => $user_status,
            'user_type' => $data['user_type'],
            'advertiser_number' => $data['advertiser_number'],
        ]);

        $permissions = $data['group_permissions'];

        $user = $this->setPermissions($user, $permissions);

        $user->branches()->sync([]);
        $user = User::find($user->id);

        foreach ($data['branches_ids'] ?? [] as $branch_id) {
            if (!$user->branches->contains($branch_id)) {
                $user->branches()->attach($branch_id);
            }
        }
    }

    public function setPermissions($user, $selected_group)
    {
        $user->permissions()->sync([]);
        $user = User::find($user->id);
        foreach ($selected_group as $name) {
            $permission = Permission::where('name', $name)->first();
            if (!$user->permissions->contains($permission->id)) {
                $user->permissions()->attach($permission->id);
            }
        }

        $fixed_permissions = config('permissions.fixed');
        $user = User::find($user->id);
        foreach ($fixed_permissions as $fixed_permission) {
            $permission = Permission::where('name', $fixed_permission)->first();
            if (!$user->permissions->contains($permission->id)) {
                $user->permissions()->attach($permission->id);
            }
        }

        $user = User::find($user->id);
        return $user;
    }
}
