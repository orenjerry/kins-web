<?php

use App\Http\Controllers\Backend\Admin_Dashboard\DataController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\Profile\ActivityController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Middleware\checkProfile;
use App\Http\Middleware\checkRole;
use App\Http\Middleware\isLoggedIn;

Route::prefix('/auth')->group(function () {
    Route::middleware([isLoggedIn::class])->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('Login');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('Register');
        Route::post('/login', [AuthController::class, 'doLogin']);
        Route::post('/register', [AuthController::class, 'doRegister']);
    });
    Route::get('/logout', [AuthController::class, 'doLogOut']);
});

Route::prefix('/profile')->group(function () {
    Route::prefix('/activity')->group(function () {
        Route::prefix('/last-online')->group(function () {
            Route::post('/set', [ActivityController::class, 'offline']);
        });
    });
    Route::get('/make-profile', [ProfileController::class, 'viewMakeProfile']);
    Route::post('/make-profile', [ProfileController::class, 'makeProfile']);
});

Route::middleware([isLoggedIn::class])->group(function () {
    Route::middleware([checkRole::class])->group(function () {
        Route::middleware([checkProfile::class])->group(function () {
            Route::get('/test', [test::class, 'test']);
            Route::get('/', function () {
                return view('welcome');
            });
            Route::prefix('/admin')->group(function () {
                Route::prefix('dashboard')->group(function () {
                    Route::get('/', [DataController::class, 'view'])->name('dashboard');
                });
            });
        });
    });
});
