<?php

namespace App\Http\Livewire;

use App\Events\NewUser as EventsNewUser;
use App\Http\Controllers\Services\SmsService;
use App\Http\Controllers\Services\UserService;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserSettings;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SmsVerification extends Component
{
    use LivewireAlert;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $verification_code;

    public $user = null;
    public $done = null;

    public $time = '03:00';
    public $timer = 180;

    public function timer()
    {
        if ($this->user) {
            if (!$this->user->can_recieve_sms) {
                $this->timer = ($this->timer - 1);
                if ($this->timer == 0) {
                    $this->user->update(['can_recieve_sms' => 1]);
                    $this->timer = 180;
                    $this->time = '03:00';
                    $this->user = User::find($this->user->id);
                }
                $this->time = date('i:s', mktime(0, 0, $this->timer));
            }
        }
    }

    public function render()
    {
        return view('livewire.sms-verification');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'password' => ['required', 'string'],
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'الايميل مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'password.required' => 'كلمة السر مطلوبة',

            'email.unique' =>  'هذا الايميل مستخدم من قبل',
            'phone.unique' =>  'رقم الهاتف مستخدم من قبل',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit(SmsService $smsService, UserService $userService)
    {
        $data = $this->validate();
        $data['user_status'] = false;
        $data['user_type'] = 'marketer';
        $data['advertiser_number'] = null;
        $data['group_permissions'] = [];
        $data['branches_ids'] = [];


        $code = random_int(111111, 999999);
        $user = $userService->store($data, $code);
        $admins = User::whereIn('user_type', ['superadmin', 'admin'])->get();
        Notification::send($admins, new NewUser($user));
        event(new EventsNewUser($user));

        $result = $smsService->send($user);

        $result = 1;

        if ($result == '1') {
            $this->user = $user;

            $this->alert('warning', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 9000,
                'text' => 'يرجى إدخال كود التحقق المكون من 6 ارقام',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('warning', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 15000,
                'text' => 'يوجد خطأ ما يرجى التحقق من بياناتك',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function sendSms()
    {
        if ($this->user->verification_code == $this->verification_code) {

            $this->user->update([
                'verification_code' => null,
                'email_verified_at' => now()
            ]);

            $this->alert('success', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 9000,
                'text' => 'شكرا لك، لقد تم التحقق من حالة الحساب الخاص بك بنجاح، يمكنك الان تسجيل الدخول',
                'timerProgressBar' => true,
            ]);

            $this->done = true;
            // return redirect()->route('login');
        }
    }

    public function resendSms(SmsService $smsService)
    {
        $code = random_int(111111, 999999);

        if ($this->user) {

            $this->user->update([
                'verification_code' => $code,
                'can_recieve_sms' => 0
            ]);

            $result = $smsService->send($this->user);

            $this->alert('warning', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 9000,
                'text' => 'لقد قمنا بإرسال كود تحقق جديد، تفقد الهاتف الخاص بك',
                'timerProgressBar' => true,
            ]);

            $this->user = User::find($this->user->id);
            $this->timer = 180;
            $this->time = '03:00';
        }
    }
}
