<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitePageController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team-photo/{path}', [TeamController::class, 'photo'])->where('path', '.+')->name('team.photo');
Route::get('/team-file/{path}', [TeamController::class, 'file'])->where('path', '.+')->name('team.file');
Route::get('/team/{teamMember:slug}', [TeamController::class, 'show'])->name('team.show');
Route::get('/{page}', SitePageController::class)
    ->where('page', 'about|services|initon|process|contact')
    ->name('pages.show');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('/about', [SettingsController::class, 'editAbout'])->name('about.edit');
        Route::put('/about', [SettingsController::class, 'updateAbout'])->name('about.update');
        Route::resource('/services', ServiceController::class)->except(['show']);
        Route::resource('/team', AdminTeamMemberController::class)->except(['show']);
        Route::resource('/clients', ClientController::class)->except(['show']);
        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});
