<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Аутентификация
Route::group(['prefix' => '/auth'], function () {
    Route::post('/login-google', [SocialAuthController::class, 'loginGoogle']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->post('/check', [AuthController::class, 'checkAuthentication']);
});

// CRUD User
//Route::middleware('auth:sanctum')->apiResources(['users' => UserController::class]);

Route::group([
    'prefix' => '/users',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/current', [UserController::class, 'current']);
});
