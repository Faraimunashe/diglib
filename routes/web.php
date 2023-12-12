<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/archive/{id}', [\App\Http\Controllers\ArchiveController::class, 'index'])->name('archive');
    Route::post('/create-archive', [\App\Http\Controllers\ArchiveController::class, 'store'])->name('create-archive');
    Route::post('/update-archive/{id}', [\App\Http\Controllers\ArchiveController::class, 'update'])->name('update-archive');
    Route::post('/delete-archive/{id}', [\App\Http\Controllers\ArchiveController::class, 'destroy'])->name('delete-archive');

    Route::post('/add-source', [\App\Http\Controllers\SourceController::class, 'store'])->name('add-source');
    Route::get('/open_or_download/{filename', [\App\Http\Controllers\SourceController::class, 'download'])->name('download-source');
    Route::post('/delete-source', [\App\Http\Controllers\SourceController::class, 'destroy'])->name('delete-source');

    Route::get('/create-document/{id}', [\App\Http\Controllers\DocumentController::class, 'index'])->name('create-document');
    Route::post('/save-document/{id}', [\App\Http\Controllers\DocumentController::class, 'store'])->name('save-document');
    Route::get('/view-document/{id}', [\App\Http\Controllers\DocumentController::class, 'show'])->name('view-document');

    Route::resource('chat', \App\Http\Controllers\ChatController::class);
});

require __DIR__.'/auth.php';
