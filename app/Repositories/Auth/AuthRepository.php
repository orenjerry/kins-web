<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository{
    public function login(Request $request);
    public function logout();
    public function register(Request $request);
}
