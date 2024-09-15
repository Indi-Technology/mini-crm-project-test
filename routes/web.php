<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLabelController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\AdminTicketLogController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Regular\RegularDashboardController;
use App\Http\Controllers\Regular\RegularTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('index');

        Route::name('tickets.')->prefix('tickets')->group(function () {
            Route::get('/', [AdminTicketController::class, 'index'])->name('index');
        });

        Route::name('ticket-logs.')->prefix('ticket-logs')->group(function () {
            Route::get('/', [AdminTicketLogController::class, 'index'])->name('index');
        });

        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
        });

        Route::name('user.')->prefix('user')->group(function () {
            Route::get('add', [AdminUserController::class, 'create'])->name('create');
            Route::post('store', [AdminUserController::class, 'store'])->name('store');
            Route::get('delete/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        });

        Route::name('categories.')->prefix('categories')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        });

        Route::name('category.')->prefix('category')->group(function () {
            Route::get('add', [AdminCategoryController::class, 'create'])->name('create');
            Route::post('store', [AdminCategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [AdminCategoryController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [AdminCategoryController::class, 'update'])->name('update');
            Route::get('delete/{id}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });

        Route::name('labels.')->prefix('labels')->group(function () {
            Route::get('/', [AdminLabelController::class, 'index'])->name('index');
        });

        Route::name('label.')->prefix('label')->group(function () {
            Route::get('add', [AdminLabelController::class, 'create'])->name('create');
            Route::post('store', [AdminLabelController::class, 'store'])->name('store');
            Route::get('edit/{id}', [AdminLabelController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [AdminLabelController::class, 'update'])->name('update');
            Route::get('delete/{id}', [AdminLabelController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/dashboard', [RegularDashboardController::class, 'index'])->name('dashboard');
    
    Route::name('user.')->prefix('user')->group(function () {
        Route::get('add', [RegularDashboardController::class, 'create'])->name('create');
        Route::post('store', [RegularDashboardController::class, 'store'])->name('store');
    });
});


Route::middleware(['auth', 'verified', 'agent'])->group(function () {
    Route::name('agent.')->prefix('agent')->group(function () {
        Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
