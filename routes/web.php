<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('kmean')->name('kmean.')->group(function () {
        Route::get('/', [App\Http\Controllers\KmeanController::class, 'index'])->name('index');
        Route::get('/result', [App\Http\Controllers\KmeanController::class, 'result'])->name('result');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/transaction.php';
