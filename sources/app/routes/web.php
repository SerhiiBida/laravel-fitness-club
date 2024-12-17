<?php

use App\Http\Controllers\Admin\Auth\AuthStaffController;
use App\Http\Controllers\Admin\CRUD\DiscountController;
use App\Http\Controllers\Admin\CRUD\MembershipController;
use App\Http\Controllers\Admin\CRUD\MembershipPurchaseController;
use App\Http\Controllers\Admin\CRUD\RoleController;
use App\Http\Controllers\Admin\CRUD\ScheduleController;
use App\Http\Controllers\Admin\CRUD\TrainingController;
use App\Http\Controllers\Admin\CRUD\TrainingRegistrationController;
use App\Http\Controllers\Admin\CRUD\TrainingTypeController;
use App\Http\Controllers\Admin\CRUD\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Публичная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('/login', [AuthStaffController::class, 'showLogin'])->name('admin.showLogin');
    Route::post('/login', [AuthStaffController::class, 'login'])->name('admin.login');
    Route::middleware(['auth:sanctum'])->get('/logout', [AuthStaffController::class, 'logout'])->name('admin.logout');
});

// Admin Dashboard
Route::middleware(['staff'])->get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

// CRUD таблиц
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['staff'],
], function () {
    Route::resources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'discounts' => DiscountController::class,
        'memberships' => MembershipController::class,
        'membership_purchases' => MembershipPurchaseController::class,
        'training_types' => TrainingTypeController::class,
        'trainings' => TrainingController::class,
        'training_registrations' => TrainingRegistrationController::class,
        'schedules' => ScheduleController::class,
    ]);
});
