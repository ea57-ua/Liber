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

Route::get('/', [HomeController::class, 'index'])
    ->name('welcome');

Route::prefix('/movies')->group(function (){
    Route::get('', [MovieController::class, 'moviesPage'])
        ->name('moviesPage');
    Route::get('/{id}', [MovieController::class, 'showMovieInfo'])
        ->name('movies.details');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/{id}/watched', [MovieController::class, 'markAsWatched'])
            ->name('movies.watched');
        Route::post('/{id}/rate', [MovieController::class, 'rate'])
            ->name('movies.rate');
        Route::post('/{id}/review', [MovieController::class, 'review'])
            ->name('movies.review');
        Route::post('/{idMovie}/lists/{idList}/toggle', [MovieController::class, 'toggleInList'])
            ->name('movies.toggleToList');
        Route::get('/{id}/share', [SocialShareButtonsController::class, 'shareMovie'])
            ->name('movies.share');
    });
});

Route::prefix('/lists')->group(function (){
    Route::get('', [ListController::class, 'listsPage'])
        ->name('listsPage');
    Route::get('/{id}', [ListController::class, 'listDetailsShow'])
        ->name('lists.details');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/create', [ListController::class, 'createList'])
            ->name('lists.create');
        Route::post('/{id}/toggle-like', [ListController::class, 'toggleLike'])
            ->name('lists.toggleLike');
        Route::get('/{id}/share', [SocialShareButtonsController::class, 'shareMovieList'])
            ->name('lists.share');
        Route::put('/{id}', [ListController::class, 'update'])
            ->name('lists.update');
    });
});

Route::get('/actors/{id}', [ActorController::class, 'showActorInfo'])
    ->name('actors.details');
Route::get('/directors/{id}', [DirectorController::class, 'showDirectorInfo'])
    ->name('directors.details');

Route::prefix('/forum')->group(function () {
    Route::get('', [ForumController::class, 'index'])
        ->name('forumPage');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/create', [ForumController::class, 'createNewPost'])
            ->name('forum.newPost');
        Route::delete('/{id}/delete', [ForumController::class, 'deletePost'])
            ->name('forum.deletePost');
        Route::post('/{id}/like', [ForumController::class, 'likeUnlikePost'])
            ->name('forum.likeUnlikePost');
        Route::get('/users', [ForumController::class, 'searchUsers'])
            ->name('forum.searchUsers');
        Route::post('/{id}/reply', [ForumController::class, 'replyPost'])
            ->name('forum.replyPost');
        Route::get('/{id}', [ForumController::class, 'showPost'])
            ->name('forum.showPost');
        Route::get('/{id}/share', [SocialShareButtonsController::class, 'shareForumPost'])
            ->name('forum.share');
        Route::post('/{id}/report', [ForumController::class, 'reportPost'])
            ->name('forum.reportPost');
    });
});


Route::middleware(['auth', 'verified'])->group(function () {
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
    Route::post('/users/{id}/follow', [UserController::class, 'follow'])
        ->name('users.follow');
    Route::post('/users/{id}/unfollow', [UserController::class, 'unfollow'])
        ->name('users.unfollow');
    Route::put('/users/{id}/blockUnblock', [UserController::class, 'blockUnblock'])
        ->name('users.blockUnblock');
    Route::post('/searchGenres', [ProfileController::class, 'searchGenres'])
        ->name('movies.searchGenres');
    Route::put('/updateFavGenres', [ProfileController::class, 'updateFavGenres'])
        ->name('profile.updateFavGenres');
    Route::delete('/deleteFavGenre', [ProfileController::class, 'deleteFavGenre'])
        ->name('profile.deleteFavGenre');
});

Route::get('users/{id}', [ProfileController::class, 'showPublicUserInfo'])
    ->name('users.publicProfile');

Route::get('termsAndConditions', function () {
    return view('termsAndConditions');
})->name('termsAndConditions');

Route::get('/social-media-share', SocialShareButtonsController::class);

// Google Authentication Routes for OAuth2
Route::get('auth/google', [SocialController::class, 'googleRedirect'])
    ->name('login.google');
Route::get('auth/google/callback', [SocialController::class, 'googleLoginOrRegister']);

require __DIR__.'/auth.php';
require __DIR__.'/admin_routes.php';
