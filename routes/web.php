<?php

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostWebController;
use App\Http\Controllers\ProfileWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthWebController::class, 'login']);

    Route::get('/signup', [AuthWebController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthWebController::class, 'signup']);
});

Route::post('/logout', [AuthWebController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileWebController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileWebController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProfileWebController::class, 'uploadImage'])->name('profile.image');

    Route::post('/posts', [PostWebController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostWebController::class, 'destroy'])->name('posts.destroy');
});
