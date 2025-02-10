<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::prefix('master')->name('master.')->group(function() {
        Route::resource('employees', App\Http\Controllers\Admin\Master\EmployeeController::class);
        Route::resource('offices', App\Http\Controllers\Admin\Master\OfficeController::class);
        Route::resource('slas', \App\Http\Controllers\Admin\Master\SlaController::class);
        Route::resource('partners', \App\Http\Controllers\Admin\Master\PartnerController::class);
        Route::resource('customers', \App\Http\Controllers\Admin\Master\CustomerController::class);
    });
});
