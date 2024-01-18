<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Default welcome route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated user dashboard route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin-specific routes under the 'admin' prefix
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/adminhome', [AdminController::class, 'adminhome'])->name('adminhome');
});
