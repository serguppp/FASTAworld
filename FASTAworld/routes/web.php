<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Handle views

// Redirect from main logging page to /upload if user is logged in
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('upload'); 
    }
    return view('welcome');
});

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth', 'verified'])->name('upload'); // Check if user is logged in

// Handle file operations with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::get('/files/{id}', [FileController::class, 'show'])->name('files.show');
    Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::put('/files/{id}/update', [FileController::class, 'update'])->name('files.update');
    Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');
    Route::get('/files/{id}/analyze', [FileController::class, 'analyze'])->name('files.analyze');
});

// Handle auth operations
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
