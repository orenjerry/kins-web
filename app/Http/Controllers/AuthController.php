<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showSignIn()
    {
        return view('signin');
    }

    public function showSignUp()
    {
        return view('signup');
    }

    public function doSignIn(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            return redirect()->intended('auth/signin')
                ->withErrors(['login' => 'Invalid username or password']);
        }
    }

    public function doSignOut()
    {
        Auth::logout();
        Session::flush();
        return redirect()->intended('auth/signin');
    }

    public function doSignUp (Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Create a new user
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect to a success page or login page
        return redirect()->route('/auth/signin')->with('success', 'Account created successfully!');
    }
}
