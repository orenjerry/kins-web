<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = session()->all();

        if (isset($auth['authorization'])) {

            if ($request->is('admin*')) {
                if ($auth['role_name'] == 'Admin' || $auth['role_name'] == 'Owner') {
                    return $next($request);
                } else {
                    abort(404);
                }
            } else {
                return $next($request);
            }
        }
    }
}
