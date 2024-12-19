<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\GlobalSearchController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\MembershipPurchaseController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\TrainingRegistrationController;
use App\Http\Controllers\Api\TrainingTypeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

// Пользователь
Route::group([
    'prefix' => '/users',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/current', [UserController::class, 'current']);
});

// Абонементы
Route::group([
    'prefix' => '/memberships',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/search', [MembershipController::class, 'search']);
    Route::get('/{id}', [MembershipController::class, 'show']);
});

// Купленные абонементы
Route::group([
    'prefix' => '/membership-purchases',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/by-user', [MembershipPurchaseController::class, 'listByUser']);
    Route::post('/check', [MembershipPurchaseController::class, 'check']);
    Route::post('/buy', [MembershipPurchaseController::class, 'buy']);
});

// Типы тренировок
Route::group([
    'prefix' => '/training-types',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [TrainingTypeController::class, 'index']);
});

// Тренировки
Route::group([
    'prefix' => '/trainings',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/search', [TrainingController::class, 'search']);
    Route::post('/check-access', [TrainingController::class, 'checkAccess']);
    Route::get('/{id}', [TrainingController::class, 'show']);
});

// Зарегистрированные на тренировки
Route::group([
    'prefix' => '/training-registrations',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/by-user', [TrainingRegistrationController::class, 'listByUser']);
    Route::post('/check', [TrainingRegistrationController::class, 'check']);
    Route::post('/register', [TrainingRegistrationController::class, 'register']);
    Route::post('/deactivate', [TrainingRegistrationController::class, 'deactivate']);
});

// Расписание на тренировки
Route::group([
    'prefix' => '/schedules',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/by-user', [ScheduleController::class, 'listByUser']);
    Route::post('/visit', [ScheduleController::class, 'createVisitUser']);
    Route::post('/cancel-visit', [ScheduleController::class, 'destroyVisitUser']);
});

// Глобальный поиск
Route::middleware(['auth:sanctum'])->get('/global-search/{name}', [GlobalSearchController::class, 'search']);
