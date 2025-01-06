<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

// Handle views
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return view('hello');
});

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth', 'verified'])->name('upload');

// Handle file operations with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/files', [FileUploadController::class, 'index'])->name('files');
    Route::post('/files/upload', [FileUploadController::class, 'upload'])->name('files.upload');
    Route::get('/files/{id}', [FileUploadController::class, 'show'])->name('files.show');
    Route::get('/files/{id}/edit', [FileUploadController::class, 'edit'])->name('files.edit');
    Route::get('/files/{id}/delete', [FileUploadController::class, 'delete'])->name('files.delete');
    Route::put('/files/{id}/update', [FileUploadController::class, 'update'])->name('files.update');

    Route::get('/files/{id}/download', [DownloadsController::class, 'download']);

});

// Handle auth operations
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
