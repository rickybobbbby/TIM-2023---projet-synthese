<?php

use App\Http\Controllers\Games\AssetController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\Games\PlayerController;
use App\Http\Controllers\Games\TokenController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'home']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/games')->group(function () {

        // Routes pertaining to a specific game
        Route::prefix('/{game}')->group(function () {
            // Play Routes
            Route::get('/', [GameController::class, 'play'])->name('game');

            // Update Routes
            Route::post('/', [GameController::class, 'update']);

            Route::post('/players', [PlayerController::class, 'invite'])->name('game.player.invite');
            Route::delete('/players/{player}', [PlayerController::class, 'kick'])->name('game.player.kick');

            // Token routes
            Route::prefix('/tokens')->group(function () {

                // Routes pertaining to a specific token
                Route::prefix('/{token}')->group(function () {
                    Route::post('/move', [TokenController::class, 'move'])->name('game.token.move');
                });
            });

            // Asset routes
            Route::prefix('/assets')->group(function () {
                Route::post('/store', [AssetController::class, 'store'])->name('game.asset.store');
            });
        });
    });
});
