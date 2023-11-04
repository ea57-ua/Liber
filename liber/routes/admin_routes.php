<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminUserController::class, 'showUsersAdminPanel'])->name('admin.users');
        Route::delete('/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.users.destroy');
    });
});
