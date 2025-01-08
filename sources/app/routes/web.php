<?php

use App\Http\Controllers\Admin\Auth\AuthStaffController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MembershipPurchaseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\TrainingRegistrationController;
use App\Http\Controllers\Admin\TrainingTypeController;
use App\Http\Controllers\Admin\UserController;
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
    Route::get('/login', [AuthStaffController::class, 'showLogin'])->name('admin.show_login');
    Route::post('/login', [AuthStaffController::class, 'login'])->name('admin.login');
    Route::middleware(['staff'])->get('/logout', [AuthStaffController::class, 'logout'])->name('admin.logout');
});

// Главная страница Dashboard
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['staff'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/generate-global-report', [ReportController::class, 'globalReport'])->name('global_report');
});

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
        'trainings' => TrainingController::class,
        'schedules' => ScheduleController::class,
        'reports' => ReportController::class,
    ]);

    Route::resource('membership-purchases', MembershipPurchaseController::class)->names('membership_purchases');
    Route::resource('training-types', TrainingTypeController::class)->names('training_types');
    Route::resource('training-registrations', TrainingRegistrationController::class)->names('training_registrations');
});
