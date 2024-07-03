<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function showLogIn()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function doLogIn(Request $request)
    {
        return $this->authRepository->login($request);
    }

    public function doLogOut()
    {
        return $this->authRepository->logout();
    }

    public function doRegister (Request $request)
    {
        return $this->authRepository->register($request);
    }
}
