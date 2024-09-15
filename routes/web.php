<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Labels;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/detail/{id}/view', [TicketController::class, 'detail'])->name('ticket.detail');
    Route::get('/tickets/filter', [TicketController::class, 'filter'])->name('ticket.filter');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/tickets/create/store', [TicketController::class, 'store'])->name('ticket.store');
    
    Route::middleware('CheckRole:agent,administrator')->group(function () {
        Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::put('/tickets/{id}/edit/update', [TicketController::class, 'update'])->name('ticket.update');
        
        Route::get('/ticket/log', [TicketController::class, 'log'])->name('ticket.log');
    });
    
    Route::middleware('CheckRole:administrator')->group(function () {
        Route::get('/dashboard', [TicketController::class, 'dashboard'])->name('dashboard');
        
        Route::delete('/tickets/{id}/destroy', [TicketController::class, 'destroy'])->name('ticket.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('akun.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('akun.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('akun.edit');
        Route::post('/user/create/store', [UserController::class, 'store'])->name('akun.store');
        Route::patch('/user/{id}/edit/update', [UserController::class, 'update'])->name('akun.update');
        Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('akun.destroy');

        Route::get('/labels', [LabelController::class, 'index'])->name('label.index');
        Route::get('/labels/create', [LabelController::class, 'create'])->name('label.create');
        Route::get('/labels/{id}/edit', [LabelController::class, 'edit'])->name('label.edit');
        Route::post('/labels/{id}/edit/update', [LabelController::class, 'update'])->name('label.update');
        Route::put('/labels/create/store', [LabelController::class, 'store'])->name('label.store');
        Route::delete('/labels/{id}/destroy', [LabelController::class, 'destroy'])->name('label.destroy');

        Route::get('/category', [CategoriesController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.create');
        Route::get('/category/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/category/{id}/edit/update', [CategoriesController::class, 'update'])->name('category.update');
        Route::put('/category/create/store', [CategoriesController::class, 'store'])->name('category.store');
        Route::delete('/category/{id}/destroy', [CategoriesController::class, 'destroy'])->name('category.destroy');
    });
});

require __DIR__ . '/auth.php';
