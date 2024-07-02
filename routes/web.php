<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['isLoggedIn'])->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });

});

Route::prefix('/auth')->group(function () {
    Route::get('/signin', [AuthController::class, 'showSignIn'])->name('signin');
    Route::post('/signin', [AuthController::class, 'doSignIn']);
    Route::get('/signout', [AuthController::class, 'doSignOut']);
    Route::get('/signup', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/signup', [AuthController::class, 'doSignUp']);
});
