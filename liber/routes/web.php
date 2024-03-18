<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/ejemplo', function () {
    return view('ejemplo');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/movies', [MovieController::class, 'moviesPage'])->name('moviesPage');

Route::get('/movies/{id}', [MovieController::class, 'showMovieInfo'])->name('movies.details');

Route::get('/lists', function () {
    return view('lists.listsPage');
})->name('listsPage');

Route::get('/forum', function () {
    return view('forum.forumIndex');
})->name('forumPage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showUserInfo'])->name('profile.edit');
    Route::post('/user/uploadImage/{id}', [ProfileController::class, 'uploadImage'])->name('user.uploadImage');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/{id}/changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});

Route::get('users/{id}', [ProfileController::class, 'showPublicUserInfo'])->name('users.publicProfile');

//Google Authentication Routes
Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('login.google');
Route::get('auth/google/callback', [SocialController::class, 'googleLoginOrRegister']);

require __DIR__.'/auth.php';

Auth::routes();

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('home');
*/
