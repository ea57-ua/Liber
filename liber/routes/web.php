<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/ejemplo', function () {
    return view('ejemplo');
});

Route::get('/', [HomeController::class, 'index'])
    ->name('welcome');

Route::get('/movies', [MovieController::class, 'moviesPage'])
    ->name('moviesPage');
Route::get('/movies/{id}', [MovieController::class, 'showMovieInfo'])
    ->name('movies.details');
Route::post('/movies/{id}/watched', [MovieController::class, 'markAsWatched'])
    ->name('movies.watched');
Route::post('/movies/{id}/rate', [MovieController::class, 'rate'])
    ->name('movies.rate');
Route::post('/movies/{id}/review', [MovieController::class, 'review'])
    ->name('movies.review');
Route::post('/movies/{idMovie}/lists/{idList}/toggle', [MovieController::class, 'toggleInList'])
    ->name('movies.toggleToList');
Route::get('/movies/{id}/share', [SocialShareButtonsController::class, 'shareMovie'])
    ->name('movies.share');

Route::get('/lists', [ListController::class, 'listsPage'])
    ->name('listsPage');

Route::get('/lists/{id}', [ListController::class, 'listDetailsShow'])
    ->name('lists.details');
Route::post('/lists/create', [ListController::class, 'createList'])
    ->name('lists.create');
Route::post('/lists/{id}/toggle-like', [ListController::class, 'toggleLike'])
    ->name('lists.toggleLike');
Route::get('/lists/{id}/share', [SocialShareButtonsController::class, 'shareMovieList'])
    ->name('lists.share');
Route::put('/lists/{id}', [ListController::class, 'update'])->name('lists.update');

Route::get('/actors/{id}', [ActorController::class, 'showActorInfo'])
    ->name('actors.details');

Route::get('/directors/{id}', [DirectorController::class, 'showDirectorInfo'])
    ->name('directors.details');

Route::get('/forum', [ForumController::class, 'index'])
    ->name('forumPage');

Route::post('/forum/create', [ForumController::class, 'createNewPost'])
    ->name('forum.newPost');
Route::delete('/forum/{id}/delete', [ForumController::class, 'deletePost'])
    ->name('forum.deletePost');
Route::post('/forum/{id}/like', [ForumController::class, 'likeUnlikePost'])
    ->name('forum.likeUnlikePost');
Route::get('/forum/users', [ForumController::class, 'searchUsers'])
    ->name('forum.searchUsers');
Route::post('/forum/{id}/reply', [ForumController::class, 'replyPost'])
    ->name('forum.replyPost');
Route::get('/forum/{id}', [ForumController::class, 'showPost'])
    ->name('forum.showPost');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showUserInfo'])
        ->name('profile.edit');
    Route::post('/user/uploadImage/{id}', [ProfileController::class, 'uploadImage'])
        ->name('user.uploadImage');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::put('/profile/{id}/changePassword', [ProfileController::class, 'changePassword'])
        ->name('profile.changePassword');
    Route::post('/profile/requestCriticStatus', [ProfileController::class, 'requestCriticStatus'])
        ->name('profile.requestCriticStatus');
    Route::post('/users/{id}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::post('/users/{id}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');
    Route::put('/users/{id}/blockUnblock', [UserController::class, 'blockUnblock'])->name('users.blockUnblock');
});

Route::get('users/{id}', [ProfileController::class, 'showPublicUserInfo'])->name('users.publicProfile');
Route::get('termsAndConditions', function () {
    return view('termsAndConditions');
})->name('termsAndConditions');

Route::get('/social-media-share', SocialShareButtonsController::class);

//Google Authentication Routes
Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('login.google');
Route::get('auth/google/callback', [SocialController::class, 'googleLoginOrRegister']);

require __DIR__.'/auth.php';
require __DIR__.'/admin_routes.php';

Auth::routes();
