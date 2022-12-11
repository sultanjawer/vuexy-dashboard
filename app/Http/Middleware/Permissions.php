<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        Gate::before(function ($user) {
            if ($user->user_type === 'superadmin') {
                return true;
            }
        });

        $permissions = Permission::all();

        foreach ($permissions as $permission) {

            Gate::define($permission->name, function ($user) use ($permission) {
                if (in_array($permission->name, $user->getPermissionsNames())) {
                    return true;
                } else {
                    return false;
                }
            });
        }

        return $next($request);
    }
}
