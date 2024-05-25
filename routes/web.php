<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
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

/* common routes */
Route::middleware('auth')->group(function () {
    /* logout routes */
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    /* change password routes */
    Route::get('change/password', [ProfileController::class, 'change_password_page'])->name('changePasswordPage');
    Route::post('change/password', [ProfileController::class, 'change_password'])->name('changePassword');
});

/* admin routes */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    /* resource controller */
    Route::resource('admin', AdminController::class);
    Route::resource('class', SchoolClassController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('assign', ClassSubjectController::class);
    Route::resource('student', StudentController::class);
    Route::resource('parent', ParentController::class);
    Route::resource('teacher', TeacherController::class);
});

/* teacher routes */
Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');

    /* profile routes */
    Route::get('my_profile', [ProfileController::class, 'teacher_profile_page'])->name('teacherProfilePage');
    Route::post('my_profile', [ProfileController::class, 'teacher_profile_update'])->name('teacherProfileUpdate');
});

/* student routes */
Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');

    /* profile routes */
    Route::get('my_profile', [ProfileController::class, 'student_profile_page'])->name('studentProfilePage');
    Route::post('my_profile', [ProfileController::class, 'student_profile_update'])->name('studentProfileUpdate');
});

/* parent routes */
Route::prefix('parent')->middleware(['auth', 'parent'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');

});
