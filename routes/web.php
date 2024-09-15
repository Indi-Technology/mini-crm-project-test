<?php

use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AdminTicketLogController;
use App\Http\Controllers\AgentCommentController;
use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();

    if ($user && $user->role == "admin") {
        return redirect('/admin/dashboard');
    } elseif ($user && $user->role == "agent") {
        return redirect('/agent/dashboard');
    } elseif ($user && $user->role == "user") {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userdashboard'])->name('dashboard');

    Route::get('/tickets', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('/tickets/detail/{id}', [TicketController::class, 'detail'])->name('ticket.detail');
    Route::post('/tickets/save', [TicketController::class, 'save'])->name('ticket.save');

    Route::post('/comments/save', [CommentController::class, 'save'])->name('comment.save');
});

Route::middleware(['auth', 'agent'])->group(function () {
    Route::get('/agent/dashboard', [DashboardController::class, 'agentdashboard'])->name('agent.dashboard');

    Route::get('/agent/tickets', [AgentTicketController::class, 'list'])->name('ticket.list');
    Route::get('/agent/tickets/detail/{id}', [AgentTicketController::class, 'detail'])->name('ticket.detail');
    Route::get('/agent/tickets/edit/{id}', [AgentTicketController::class, 'edit'])->name('ticket.edit');
    Route::post('/agent/tickets/status/change', [AgentTicketController::class, 'changestatus'])->name('ticket.changestatus');
    Route::post('/agent/tickets/update', [AgentTicketController::class, 'update'])->name('ticket.update');


    Route::post('/agent/comments/save', [AgentCommentController::class, 'save'])->name('comment.save');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admindashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'list'])->name('user.list');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name(
        'user.create'
    );
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/users/save', [UserController::class, 'save'])->name('user.save');
    Route::post('/admin/users/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/admin/users/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/admin/labels', [LabelController::class, 'list'])->name('label.list');
    Route::get('/admin/labels/create', [LabelController::class, 'create'])->name('label.list');
    Route::post('/admin/labels/save', [LabelController::class, 'save'])->name('label.save');
    Route::get('/admin/labels/edit/{id}', [LabelController::class, 'edit'])->name('label.edit');
    Route::post('/admin/labels/delete', [LabelController::class, 'delete'])->name('label.delete');
    Route::post('/admin/labels/update', [LabelController::class, 'update'])->name('label.update');

    Route::get('/admin/categories', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/admin/categories/save', [CategoryController::class, 'save'])->name('category.save');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/admin/categories/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/admin/categories/update', [CategoryController::class, 'update'])->name('category.update');

    Route::get('/admin/tickets', [AdminTicketController::class, 'list'])->name('ticket.list');
    Route::get('/admin/tickets/edit/{id}', [AdminTicketController::class, 'edit'])->name('ticket.edit');
    Route::get('/admin/tickets/detail/{id}', [AdminTicketController::class, 'detail'])->name('ticket.detail');
    Route::post('/admin/tickets/update', [AdminTicketController::class, 'update'])->name('ticket.update');
    Route::post('/admin/tickets/delete', [AdminTicketController::class, 'delete'])->name('ticket.delete');
    Route::post('/admin/tickets/status/change', [AdminTicketController::class, 'changestatus'])->name('ticket.changestatus');

    Route::post('/admin/comments/save', [AdminCommentController::class, 'save'])->name('comment.save');

    Route::get('/admin/logs', [AdminTicketLogController::class, 'list'])->name('logs.list');
    Route::get('/admin/logs/detail/{id}', [AdminTicketLogController::class, 'detail'])->name('logs.detail');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
