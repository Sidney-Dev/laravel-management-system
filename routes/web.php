<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function() {
    Route::view('/', 'dashboard.index')->name('dashboard');

    Route::prefix('projects')->group(function() {
        Route::get('/', [ProjectsController::class, 'index'])->name('project.index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('project.create');
        Route::post('/', [ProjectsController::class, 'store'])->name('project.store');
        Route::delete('/{project}/delete', [ProjectsController::class, 'delete'])->name('project.delete');
        Route::get('/{project}/edit', [ProjectsController::class, 'edit'])->name('project.edit');
        Route::patch('/{project}/update', [ProjectsController::class, 'update'])->name('project.update');

        Route::get('/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
        Route::get('/{project}/tasks/create', [TaskController::class, 'create'])->name('task.create');
        Route::get('/{project}/tasks/{task}', [TaskController::class, 'show'])->name('task.show');
        Route::delete('/{project}/tasks/{task}/delete', [TaskController::class, 'delete'])->name('task.delete');
        Route::get('/{project}/tasks', [TaskController::class, 'index'])->name('task.index');
        Route::post('/{project}/tasks', [TaskController::class, 'store'])->name('task.store');
    });

});

require __DIR__.'/auth.php';
