<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;


// Handle views

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return view('hello');
});

Route::get('/database', function(){
    return view('database');
})->name('database');

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth', 'verified'])->name('upload');

// Handle file operations

Route::post('/uploadfile', [FileUploadController::class, 'upload'])->name('file.upload');

Route::get('/files/{filename}', [FileUploadController::class, 'show'])->name('file.show');

// Handle auth operations

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
