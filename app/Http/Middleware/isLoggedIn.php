<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class isLoggedIn
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id')) {
            return redirect('auth/login');
        } elseif ($request->is('auth*')) {
            return redirect()->back();
        }
        return $next($request);
    }
}
