<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('app'); // Serve the Vue application
});

Route::prefix('api/tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']); // Get all tasks
    Route::post('/', [TaskController::class, 'store']); // Create a new task
    Route::get('/{id}', [TaskController::class, 'show']); // Get a specific task
    Route::put('/{id}', [TaskController::class, 'update']); // Update a task
    Route::delete('/{id}', [TaskController::class, 'destroy']); // Delete a task
});
