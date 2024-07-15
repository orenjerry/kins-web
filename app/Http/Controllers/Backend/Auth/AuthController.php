<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function showLogIn()
    {
        return view('content.auth.login');
    }

    public function showRegister()
    {
        return view('content.auth.register');
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