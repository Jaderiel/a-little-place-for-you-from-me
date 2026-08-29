<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/story', [PageController::class, 'story'])->name('story');
Route::get('/memories', [PageController::class, 'memories'])->name('memories');
Route::get('/lore', [PageController::class, 'lore'])->name('lore');
Route::get('/wrapped/{year?}', [PageController::class, 'wrapped'])->whereNumber('year')->name('wrapped');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/api/lore/random', [InteractionController::class, 'randomLore'])->name('lore.random');
Route::get('/api/bad-day', [InteractionController::class, 'randomSupportMessage'])->name('bad-day');
Route::post('/api/trivia/check', [InteractionController::class, 'checkAnswer'])->name('trivia.check');

// Hidden on purpose: never linked from the navigation.
Route::get('/secret', [SecretController::class, 'show'])->name('secret');
Route::post('/secret', [SecretController::class, 'unlock'])->middleware('throttle:10,1')->name('secret.unlock');
Route::post('/secret/lock', [SecretController::class, 'lock'])->name('secret.lock');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'show'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->middleware('throttle:10,1');
});

Route::post('/admin/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/{resource}', [ResourceController::class, 'index'])->name('resource.index');
    Route::get('/{resource}/create', [ResourceController::class, 'create'])->name('resource.create');
    Route::post('/{resource}', [ResourceController::class, 'store'])->name('resource.store');
    Route::get('/{resource}/{id}/edit', [ResourceController::class, 'edit'])->name('resource.edit');
    Route::put('/{resource}/{id}', [ResourceController::class, 'update'])->name('resource.update');
    Route::delete('/{resource}/{id}', [ResourceController::class, 'destroy'])->name('resource.destroy');
});
