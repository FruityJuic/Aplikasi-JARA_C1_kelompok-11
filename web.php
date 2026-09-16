<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', [
    TaskController::class,
    'index'
])->name('tasks.index');

Route::post('/tasks', [
    TaskController::class,
    'store'
])->name('tasks.store');