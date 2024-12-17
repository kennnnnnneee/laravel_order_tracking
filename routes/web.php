<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;

// Admin Order Management
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
});


Route::get('/', [OrderController::class, 'index'])->name('orders.index'); // Main page
Route::get('/status/to-pay', [OrderController::class, 'toPay'])->name('orders.toPay');
Route::get('/status/to-ship', [OrderController::class, 'toShip'])->name('orders.toShip');
Route::get('/status/to-deliver', [OrderController::class, 'toDeliver'])->name('orders.toDeliver');
Route::get('/status/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
Route::post('/orders/{id}/receive', [OrderController::class, 'receive'])->name('orders.receive');

