<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Anjez Platform (منصة أنجز)
|--------------------------------------------------------------------------
*/

// Public Single-Page Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Service Management
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::patch('services/{service}/toggle-active', [ServiceController::class, 'toggleActive'])->name('services.toggle-active');

        // Portfolio & Samples Management
        Route::resource('portfolio', PortfolioItemController::class)->except(['show']);
        Route::patch('portfolio/{portfolio}/toggle-featured', [PortfolioItemController::class, 'toggleFeatured'])->name('portfolio.toggle-featured');

        // Platform Settings (WhatsApp, Hero text, About text)
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
