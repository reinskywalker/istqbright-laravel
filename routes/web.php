<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\QuestionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => view('welcome'));

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/adminhome', [AdminController::class, 'adminhome'])->name('adminhome');

    Route::get('/createSection', [SectionsController::class, 'createSection'])->name('createSection');
    Route::post('/storeSection/section', [SectionsController::class, 'storeSection'])->name('storeSection');

    Route::get('/editSection/{section}', [SectionsController::class, 'editSection'])->name('editSection');
    Route::post('/updateSection/{section}', [SectionsController::class, 'updateSection'])->name('updateSection');

    Route::get('/listSection', [SectionsController::class, 'listSection'])->name('listSection');
    Route::get('/detailSection/{section}', [SectionsController::class, 'detailSection'])->name('detailSection');

    Route::get('/createQuestion/{section}', [QuestionsController::class, 'createQuestion'])->name('createQuestion');
    Route::get('/detailQuestion/{question}', [QuestionsController::class, 'detailQuestion'])->name('detailQuestion');

    Route::post('/setStoredQuestion/{section}', [QuestionsController::class, 'setStoredQuestion'])->name('setStoredQuestion');
});
