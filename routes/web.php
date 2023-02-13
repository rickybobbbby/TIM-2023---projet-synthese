<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/games')->group(function() {

        // Routes pertaining to a specific game
        Route::prefix('/{game}')->group(function() {

            // Token routes
            Route::prefix('/tokens')->group(function() {

                // Routes pertaining to a specific token
                 Route::prefix('/{token}')->group(function() {
                     Route::post('/move', [\App\Http\Controllers\Games\TokenController::class, 'move']);
                 });
            });
        });
    });
});
