<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use Illuminate\Support\Facades\Route;

/* login routes */
Route::prefix('/')->group(function () {
    Route::get('', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('', [AuthController::class, 'login'])->name('login');

    /* forgot password routes */
    Route::get('forgot/password', [AuthController::class, 'forgot_password_page'])->name('forgotPasswordPage');
    Route::post('forgot/password', [AuthController::class, 'forgot_password'])->name('forgotPassword');

    /* reset password routes */
    Route::get('reset/password/{token}', [AuthController::class, 'reset_password_page'])->name('resetPasswordPage');
    Route::post('reset/password/{token}', [AuthController::class, 'reset_password'])->name('resetPassword');
});

/* logout routes */
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

/* admin routes */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    /* resource controller */
    Route::resource('admin', AdminController::class);
    Route::resource('class', SchoolClassController::class);

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
