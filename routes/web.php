<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userdashboard'])->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admindashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'list'])->name('user.list');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name(
        'user.create'
    );
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('user.list');
    Route::post('/admin/users/save', [UserController::class, 'save'])->name('user.save');
    Route::post('/admin/users/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/admin/users/update', [UserController::class, 'update'])->name('user.update');
});

Route::middleware(['auth', 'agent'])->group(function () {
    Route::get('/agent/dashboard', [DashboardController::class, 'agentdashboard'])->name('agent.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
