<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/* login routes */
Route::prefix('/')->group(function () {
    Route::get('', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('', [AuthController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    /* logout routes */
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');






    
    Route::get('dashboard', [Controller::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('admin/list', [Controller::class, 'admin_list'])->name('admin.list');
});
