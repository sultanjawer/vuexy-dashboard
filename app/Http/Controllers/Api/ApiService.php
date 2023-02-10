<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiService extends Controller
{
    protected $filters = [];

    public function index($models = 'users', $limit = 10, $search = '')
    {
        if ($models == 'users') {
            return $this->get_users($limit, $search);
        }
    }

    public function mkResponse($data)
    {
        return response()->json($data);
    }

    public function get_users($limit = 10, $search)
    {
        $headers = request()->header();

        $this->filters['user_type'] = null;
        $this->filters['user_status'] = null;
        $this->filters['branch_id'] = null;

        if (request()->header('user_type')) {
            $this->filters['user_type'] = request()->header('user_type') == 'all' ? null : request()->header('user_type');
        }

        if (request()->header('user_status')) {
            $this->filters['user_status'] = request()->header('user_status') == 'all' ? null : request()->header('user_status');
        }

        if (request()->header('branch_id')) {
            $this->filters['branch_id'] = request()->header('branch_id');
        }

        $this->filters['search'] = $search;

        $users = User::data()->filters($this->filters)->paginate($limit);
        $res = ['data' => $users, 'branches' => getBranches()];
        return $this->mkResponse($res);
    }

    public function usersTypesCount()
    {
        $users = getUsers();
        $all  = $users->count();
        $m_c = $users->where('user_type', 'marketer')->count();
        $a_c = $users->where('user_type', 'admin')->count();
        $o_c = $users->where('user_type', 'office')->count();
        $res = ["admins" => $a_c, "marketers" => $m_c, "officers" => $o_c, "all" => $all];

        return $this->mkResponse($res);
    }
}
