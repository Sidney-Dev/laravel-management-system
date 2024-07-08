<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->group(function() {
    Route::view('/', 'dashboard.index');

    Route::prefix('projects')->group(function() {
        Route::get('/', [ProjectsController::class, 'create'])->name('project.create');
        Route::post('/', [ProjectsController::class, 'store'])->name('project.store');
    });

});

require __DIR__.'/auth.php';
