<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/tasks', TaskController::class);

Route::get('/task', [TaskController::class, 'index'])->name('task.index');
Route::get('/tasks', [TaskController::class, 'create'])->name('task.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';