<?php

use App\Http\Controllers\Admin\Auth\AuthStaffController;
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
    Route::get('/login', [AuthStaffController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthStaffController::class, 'login'])->name('login');
    Route::middleware(['auth:sanctum'])->get('/logout', [AuthStaffController::class, 'logout'])->name('logout');
});

// Admin Dashboard(Нужно проверка на доступ к Админке!! Нужно ПО свое!!)
Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
