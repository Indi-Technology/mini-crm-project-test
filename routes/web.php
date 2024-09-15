<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Attachment
    Route::get('/attachments/download/{id}', [AttachmentController::class, 'download'])->name('attachments.download');

    // Profile Management by Everyone
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ticket Management by Everyone
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{id}/close', [TicketController::class, 'close'])->name('tickets.close');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // Comment Management by Everyone
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::middleware('role:admin')->group(function () {
        // Ticket Management by Admin
        Route::put('/tickets/{id}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
        Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');

        // Log Management by Admin
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

        // Attachment Management by Admin
        Route::delete('/attachments/{id}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');

        // User Management by Admin
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Category Management by Admin
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Label Management by Admin
        Route::get('/labels', [LabelController::class, 'index'])->name('labels.index');
        Route::get('/labels/create', [LabelController::class, 'create'])->name('labels.create');
        Route::post('/labels', [LabelController::class, 'store'])->name('labels.store');
        Route::get('/labels/{id}/edit', [LabelController::class, 'edit'])->name('labels.edit');
        Route::put('/labels/{id}', [LabelController::class, 'update'])->name('labels.update');
        Route::delete('/labels/{id}', [LabelController::class, 'destroy'])->name('labels.destroy');

    });
});

require __DIR__.'/auth.php';