<?php

use \App\Http\Controllers\TeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/dashboard', [TeaController::class, 'index'])->name('dashboard');
   Route::get('/dashboard/filterC', [TeaController::class, 'index'])->name('dashboard.filteredC');
   Route::get('/dashboard/filterH', [TeaController::class, 'index'])->name('dashboard.filteredH');
   Route::post('/dashboard', [TeaController::class, 'store'])->name('dashboard.store');
   Route::delete('/dashboard/{tea}', [TeaController::class, 'destroy'])->name('dashboard.destroy');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/2025', [TeaController::class, 'index2'])->name('2025');
    Route::get('/2025/filterC', [TeaController::class, 'index2'])->name('2025.filteredC');
    Route::get('/2025/filterH', [TeaController::class, 'index2'])->name('2025.filteredH');
    Route::post('/2025', [TeaController::class, 'store2'])->name('2025.store');
    Route::delete('/2025/{tea}', [TeaController::class, 'destroy2'])->name('2025.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
