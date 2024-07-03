<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\test;
use App\Http\Middleware\checkRole;
use App\Http\Middleware\isLoggedIn;

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('Login');
    Route::post('/login', [AuthController::class, 'doLogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('Register');
    Route::post('/register', [AuthController::class, 'doRegister']);
    Route::get('/logout', [AuthController::class, 'doLogOut']);
});

Route::middleware([isLoggedIn::class])->group(function () {
    Route::middleware([checkRole::class])->group(function () {
        Route::get('/test', [test::class, 'test']);
        Route::get('/', function () {
            return view('welcome');
        });
        Route::prefix('/admin')->group(function () {
            Route::get('/dashboard', [DataController::class, 'view'])->name('dashboard');
        });
    });
});
