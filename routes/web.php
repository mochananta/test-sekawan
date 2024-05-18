<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('admin.admin');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/edit',[OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}',[OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}',[OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
});

Route::middleware(['auth', 'role:atasan1'])->group(function () {
    Route::get('/atasan1', function () {
        return view('atasan.atasan1');
    });

    Route::post('/orders/{id}/approve-atasan1', [OrderController::class, 'approveAtasan1'])->name('orders.approveAtasan1');
});

Route::middleware(['auth', 'role:atasan2'])->group(function () {
    Route::get('/atasan2', function () {
        return view('atasan.atasan2');
    });

    Route::post('/orders/{id}/approve-atasan2', [OrderController::class, 'approveAtasan2'])->name('orders.approveAtasan2');
});
