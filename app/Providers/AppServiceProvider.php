<?php

// app/Providers/RouteServiceProvider.php
namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        // Daftarkan middleware
        Route::aliasMiddleware('role', CheckRole::class);
    }
}
