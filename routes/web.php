<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListMemberController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get(
        '/lists/{taskList}/members',
        [ListMemberController::class, 'index']
    )->name('lists.members.index');

    Route::post(
        '/lists/{taskList}/members',
        [ListMemberController::class, 'store']
    )->name('lists.members.store');

    Route::delete(
        '/lists/{taskList}/members/{user}',
        [ListMemberController::class, 'destroy']
    )->name('lists.members.destroy');

});

Route::middleware('auth')->group(function () {

    Route::get(
        '/lists/{taskList}/progress',
        [ProgressController::class, 'index']
    )->name('lists.progress');

});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get(
        '/users',
        [UserManagementController::class, 'index']
    )->name('admin.users.index');

    Route::get(
        '/users/create',
        [UserManagementController::class, 'create']
    )->name('admin.users.create');

    Route::post(
        '/users',
        [UserManagementController::class, 'store']
    )->name('admin.users.store');

    Route::delete(
        '/users/{user}',
        [UserManagementController::class, 'destroy']
    )->name('admin.users.destroy');

});