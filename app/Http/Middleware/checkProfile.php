<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class checkProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = session()->all();

        if (isset($auth)) {
            $user = User::find($auth['user_id']);
            $profile = Profile::where('id_user', $user['id'])->first();

            if ($profile) {
                return $next($request);
            } else {
                return redirect('/profile/make-profile');
            }
        }
        return $next($request);
    }
}
