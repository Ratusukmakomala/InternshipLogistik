<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('transaction')->name('transaction.')->group(function () {
    Route::resource('deliveries', \App\Http\Controllers\Transaction\DeliveryController::class)->except(['show']);
    Route::prefix('deliveries')->name('deliveries.')->group(function() {
        Route::get('tracking', [\App\Http\Controllers\Transaction\DeliveryController::class, 'detailTracking'])->name('tracking');
    });
    Route::prefix('report')->name('report.')->group(function() {
        Route::get('/', [\App\Http\Controllers\Transaction\ReportControler::class, 'index'])->name('index');
        Route::get('/cod', [\App\Http\Controllers\Transaction\ReportControler::class, 'cod'])->name('cod');
        Route::get('/sender', [\App\Http\Controllers\Transaction\ReportControler::class, 'senderReport'])->name('sender');
        Route::get('/receiver', [\App\Http\Controllers\Transaction\ReportControler::class, 'receiverReport'])->name('receiver');
        Route::prefix('search')->name('search.')->group(function() {
            Route::get('/', [\App\Http\Controllers\Transaction\ReportControler::class, 'search'])->name('index');
            Route::get('/result', [\App\Http\Controllers\Transaction\ReportControler::class, 'searchResult'])->name('result');
        });
        Route::get('/history/{id}', [\App\Http\Controllers\Transaction\ReportControler::class, 'showHistory'])->name('history');

        Route::prefix('export')->name('export.')->group(function() {
            Route::get('/delivery', [\App\Http\Controllers\Transaction\ReportExportController::class, 'deliveryExport'])->name('delivery');
            Route::get('/sender', [\App\Http\Controllers\Transaction\ReportExportController::class, 'senderExport'])->name('sender');
            Route::get('/receiver', [\App\Http\Controllers\Transaction\ReportExportController::class, 'receiverExport'])->name('receiver');
            Route::get('/cod', [\App\Http\Controllers\Transaction\ReportExportController::class, 'codExport'])->name('cod');
            Route::get('/search', [\App\Http\Controllers\Transaction\ReportExportController::class, 'searchExport'])->name('search');
        });
    });
});
