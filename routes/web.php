<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomecellController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ReportController;

// Guest routes (login, register, password reset)
require __DIR__.'/auth.php';

// Dashboard route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Super Admin routes
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('homecells', HomecellController::class);
        Route::resource('ministries', MinistryController::class);
        Route::resource('members', MemberController::class);
        Route::resource('families', FamilyController::class);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Homecell Pastor routes
    Route::middleware('role:homecell_pastor')->group(function () {
        Route::resource('homecells', HomecellController::class)->only(['index', 'show']);
        Route::resource('members', MemberController::class)->only(['index', 'show']);
    });

    Route::middleware(['auth'])->group(function () {
    Route::resource('members', MemberController::class);
});


    // Ministry Leader routes
    Route::middleware('role:ministry_leader')->group(function () {
        Route::resource('ministries', MinistryController::class)->only(['index', 'show']);
        Route::resource('members', MemberController::class)->only(['index', 'show']);
    });
});
