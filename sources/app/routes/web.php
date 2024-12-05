<?php

use App\Http\Controllers\Admin\Auth\AuthController;
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
    'prefix' => 'auth',
], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware(['auth:sanctum'])->get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Dashboard(Нужно проверка на доступ к Админке!! Нужно ПО свое!!)
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
