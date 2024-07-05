<?php

namespace App\Repositories\Auth;

use App\Http\Response\ResponseArray;
use App\Models\Role;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthRepositoryImplement extends Eloquent implements AuthRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $response;

    public function __construct(ResponseArray $response)
    {
        $this->response = $response;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);
            $credentials = $request->only('username', 'password');
            $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $token = Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']]);

            if (!$token) {
                return $this->response->returnArray(401, 'Unauthorized', $token);
            }
            $user = Auth::user();
            $role = Role::find($user->role_id);

            $online = User::find($user->id);
            if ($online) {
                $firstOnline = $online['first_online_at'];
                if (!$firstOnline) {
                    $online->first_online_at = date('Y-m-d H:i:s');
                }
                $online->last_online_at = date('Y-m-d H:i:s');
                $online->save();
            }

            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]);

            Cookie::queue(Cookie::make('user_id', $user->id, 125));

            return $this->response->returnArray(200, 'Successfully authorized', [
                'user' => $user,
                'role_name' => $role->name,
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return $this->response->returnArray(500, $e->getMessage(), $e->getMessage());
        }
    }

    public function logout()
    {
        $auth = session()->all();

        if ($auth) {
            Cookie::queue(Cookie::forget('user_id'));

            $userId = session('user_id');
            if ($userId) {
                $online = User::find($userId);
                if ($online) {
                    $online->last_online_at = null;
                    $online->save();
                }
            }
            // Auth::logout();
            session()->flush();

            return redirect('/auth/login')->with('message', 'Successfully signed out');
        } else {
            return redirect('/auth/login')->withErrors('message', 'Unknown session.');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if username already exists
        $checkUsn = User::where('username', $request->input('username'))->first();
        if ($checkUsn) {
            return $this->response->returnArray(500, 'Username already exists', []);
        }

        // Check if email already exists
        $checkEmail = User::where('email', $request->input('email'))->first();
        if ($checkEmail) {
            return $this->response->returnArray(500, 'Email already exists', []);
        }

        // Create the user
        User::create([
            'username' => strtolower($request->input('username')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 3,
        ]);
        session()->flash('message', 'Account created successfully!');

        return response()->json([
            'status' => 201,
            'redirect_url' => url('/auth/login')
        ]);
    }
}
