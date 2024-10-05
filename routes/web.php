<?php

use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoarderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/boarders', [BoarderController::class, 'index'])->name('boarder.index');
    Route::get('/boarders/search', [BoarderController::class, 'search'])->name('boarder.search');
    Route::get('/boarders/create', [BoarderController::class, 'create'])->name('boarder.create');
    Route::get('/boarders/{boarder}', [BoarderController::class, 'edit'])->name('boarder.edit');
    Route::post('/boarders/create', [BoarderController::class, 'store'])->name('boarder.store');
    Route::put('/boarders/{boarder}', [BoarderController::class, 'update'])->name('boarder.update');
    Route::delete('/boarders/{boarder}', [BoarderController::class, 'destroy'])->name('boarder.destroy');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('/payments/search', [PaymentController::class, 'search'])->name('payment.search');
    Route::post('/payments/create', [PaymentController::class, 'store'])->name('payment.store');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payment.destroy');
    Route::get('/payments/{payment}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payment.update');

    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    Route::get('/balance/search', [BalanceController::class, 'search'])->name('balance.search');
});

require __DIR__.'/auth.php';
