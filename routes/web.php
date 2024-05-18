<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/* login routes */
Route::prefix('/')->group(function () {
    Route::get('', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('', [AuthController::class, 'login'])->name('login');
});

/* logout routes */
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

/* admin routes */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/list', [Controller::class, 'admin_list'])->name('admin.list');

});

/* teacher routes */
Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');

});

/* student routes */
Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');

});

/* parent routes */
Route::prefix('parent')->middleware(['auth', 'parent'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');

});
