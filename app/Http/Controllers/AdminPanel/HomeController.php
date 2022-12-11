<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\UserService;
use App\Models\Branch;
use App\Models\City;
use App\Models\Customer;
use App\Models\Direction;
use App\Models\LandType;
use App\Models\Licensed;
use App\Models\Mediator;
use App\Models\Neighborhood;
use App\Models\Order;
use App\Models\PropertyType;
use App\Models\Street;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function home()
    {
        return view('admin-panel.home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin-panel.user.profile', ['user' => $user]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin-panel.user.users', compact(['users']));
    }

    public function orders()
    {
        return view('admin-panel.order.orders');
    }

    public function reservations()
    {
        return view('admin-panel.reservation.reservations');
    }

    public function customers()
    {
        $customers = Customer::data()->paginate(10);
        return view('admin-panel.customer.customers', compact(['customers']));
    }

    public function branches()
    {
        $branches = Branch::data()->paginate(10);
        $cities = City::data()->get();
        return view('admin-panel.branch.branches', compact(['branches', 'cities']));
    }

    public function mediators()
    {
        return view('admin-panel.mediator.mediators');
    }

    public function sms()
    {
        return view('admin-panel.sms.sms');
    }

    public function cities()
    {
        return view('admin-panel.city.cities');
    }

    public function neighborhoods()
    {
        return view('admin-panel.neighborhood.neighborhoods');
    }

    public function user(User $user)
    {
        return view('admin-panel.user.user-view', ['user' => $user]);
    }

    public function createUser()
    {
        return view('admin-panel.user.create-user');
    }

    public function updateUser(User $user)
    {
        return view('admin-panel.user.edit-user', ['user' => $user]);
    }

    public function order(Order $order)
    {
        $user = auth()->user();
        return view('admin-panel.order.order-view', compact(['order']));
    }

    public function ordersMarketer()
    {
        return view('admin-panel.order.orders-marketer');
    }

    public function newUser()
    {
        return view('admin-panel.user.new-user');
    }

    public function forgetPassword()
    {
        return view('auth.passwords.forget-password');
    }

    public function checkForgetPassword()
    {
        $request = request();
        $user_email = User::where('email', $request->email_or_phone_number)->first();
        $user_phone = User::where('phone', $request->email_or_phone_number)->first();

        if ($user_email) {
            return view('auth.passwords.reset-password', ['user_id' => $user_email->id]);
        }

        if ($user_phone) {
            return view('auth.passwords.reset-password', ['user_id' => $user_phone->id]);
        }

        return redirect()->back()->with('email_or_phone_number', 'يرجى التحقق من صحة البيانات');
    }


    public function customerOrder($user_id)
    {
        $user = User::find($user_id);

        if (!$user || $user->user_status == 'inactive') {
            abort(404, 'This user is not found.');
        } else {
            if ($user->user_type != 'marketer') {
                abort(404);
            }
        }

        return view('admin-panel.order.customer-order', ['user_id' => $user_id]);
    }

    public function changePassword()
    {
        return view('admin-panel.user.change-password');
    }

    public function updatePassword(UserService $userService)
    {
        return $userService->changePassword();
    }

    public function pageResetPassword($user_id)
    {
        return view('auth.passwords.reset-password', ['user_id' => $user_id]);
    }

    public function resetPassword()
    {
        return $this->userService->resetPassword();
    }
}
