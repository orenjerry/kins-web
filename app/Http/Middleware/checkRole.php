<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /*
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = session()->all();

        if (isset($auth)) {
            if ($request->is('admin*')) {
                $user = User::find($auth['user_id']);
                $role = Role::find($user->role_id);
                if ($role['name'] == 'Admin' || $role['name'] == 'Owner') {
                    return $next($request);
                } else {
                    abort(404);
                }
            }
            return $next($request);
        }
    }
}
