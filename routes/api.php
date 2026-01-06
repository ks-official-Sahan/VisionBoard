<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\ProfileApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| VisionBoard JSON API Routes
|--------------------------------------------------------------------------
*/

Route::post('/auth/signup', [AuthApiController::class, 'signup']);
Route::post('/auth/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);

    Route::get('/profile', [ProfileApiController::class, 'show']);
    Route::put('/profile', [ProfileApiController::class, 'update']);
    Route::post('/profile/image', [ProfileApiController::class, 'uploadImage']);

    Route::post('/posts', [PostApiController::class, 'store']);
    Route::delete('/posts/{post}', [PostApiController::class, 'destroy']);
});

Route::get('/posts', [PostApiController::class, 'index']);
