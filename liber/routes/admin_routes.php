<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminUserController::class, 'showUsersAdminPanel'])->name('admin.users');
        Route::delete('/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::get('/create', [AdminUserController::class, 'showCreateUser'])->name('admin.users.create');
        Route::post('/create', [AdminUserController::class, 'createUser'])->name('admin.users.create.save');
        Route::get('/{id}', [AdminUserController::class, 'showUser'])->name('admin.users.show');
        Route::get('/{id}/edit', [AdminUserController::class, 'showEditUser'])->name('admin.users.edit');
        Route::post('/{id}/edit', [AdminUserController::class, 'editUser'])->name('admin.users.edit.save');
    });
});