<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskListController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::resource('task-lists', TaskListController::class)
        ->only([
            'index',
            'create',
            'store',
            'show',
            'destroy'
        ]);

});