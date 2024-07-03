<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;

class isLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = session()->all();

        if (isset($auth['authorization'])) {
            $token = $auth['authorization']['token'];
            $type = $auth['authorization']['type'];

            if ($type === 'Bearer') {
                $isCheck = AccessToken::where('token', $token)->first();

                if ($isCheck) {
                    if ($isCheck->expired_at >= date('Y-m-d H:i:s')) {
                        return $next($request);
                    } else {
                        return redirect('auth/login');
                    }
                } else {
                    $online = User::find($auth['user_id']);
                    if ($online) {
                        $online->online_at = null;
                        $online->save();
                    }

                    session()->flush();
                    Cookie::queue(Cookie::forget('user_id'));
                    return redirect('auth/login');
                }
            } else {
                return redirect('auth/login');
            }
        }

        $online = User::find(Cookie::get('user_id'));
        if ($online) {
            $online->online_at = null;
            $online->save();
        }

        Cookie::queue(Cookie::forget('user_id'));

        return redirect('auth/login');
    }
}
