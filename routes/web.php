<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PrioritiesController;
use App\Http\Controllers\RegistUserController;
use App\Http\Controllers\TicketsAgentController;
use App\Http\Controllers\TicketsRegularController;
use App\Http\Controllers\CommentsRegularController;
use App\Http\Controllers\CommentRegularController;

Route::get('/', function () {
    return view('login');
});

// Rute dashboard dengan nama admin.dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

// // Rute lainnya
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Rute /admin juga diarahkan ke dashboard dengan nama
Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('/admin/RegistUser', RegistUserController::class);

//Register
Route::resource('/register', RegisterController::class);

//Tickets
Route::resource('/admin/tickets', TicketsController::class);
Route::post('/admin/tickets/store', [TicketsController::class, 'store'])->name('tickets.store');

//label
Route::resource('/admin/labels', LabelsController::class);

//categories
Route::resource('/admin/categories', CategoriesController::class);

//priorities
Route::resource('/admin/priorities', PrioritiesController::class);

Route::prefix('agent')->name('agent.')->group(function () {
    Route::get('/tickets', [TicketsAgentController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}/edit', [TicketsAgentController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketsAgentController::class, 'update'])->name('tickets.update');
});


Route::prefix('regular')->name('regular.')->group(function () {
    Route::get('/tickets', [TicketsRegularController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketsRegularController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketsRegularController::class, 'store'])->name('tickets.store');
    Route::post('/comment/store', [CommentRegularController::class, 'store'])->name('comment.store');
});
