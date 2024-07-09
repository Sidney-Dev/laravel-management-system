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

Route::middleware('auth')->prefix('dashboard')->group(function() {
    Route::view('/', 'dashboard.index')->name('dashboard');

    Route::prefix('projects')->group(function() {
        Route::get('/', [ProjectsController::class, 'index'])->name('project.index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('project.create');
        Route::post('/', [ProjectsController::class, 'store'])->name('project.store');
        Route::delete('/{project}/delete', [ProjectsController::class, 'delete'])->name('project.delete');
        Route::get('/{project}/edit', [ProjectsController::class, 'edit'])->name('project.edit');
        Route::patch('/{project}/update', [ProjectsController::class, 'update'])->name('project.update');
    });

});

require __DIR__.'/auth.php';
