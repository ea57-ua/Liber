<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\DirectorController as AdminDirectorController;
use App\Http\Controllers\Admin\ActorController as AdminActorController;
use App\Http\Controllers\Admin\ReportsController as AdminReportController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified' ,'admin'])->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/applications',
        [AdminController::class, 'showCriticApplications'])
        ->name('admin.applications');
    Route::put('/applications/{id}/updateStatus',
        [AdminController::class, 'updateCriticStatus'])
        ->name('admin.applications.update');

    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminUserController::class, 'showUsersAdminPanel'])
            ->name('admin.users');
        Route::delete('/{id}', [AdminUserController::class, 'destroyUser'])
            ->name('admin.users.destroy');
        Route::get('/create', [AdminUserController::class, 'showCreateUser'])
            ->name('admin.users.create');
        /*Route::post('/create', [AdminUserController::class, 'createUser'])
            ->name('admin.users.create.save');
            TODO: quitar ?
        */
        Route::put('/{id}', [AdminUserController::class, 'toggleBlock'])
            ->name('admin.users.toggleBlock');
    });

    Route::prefix('/movies')->group(function () {
        Route::get('/', [AdminMovieController::class, 'showMoviesAdminPanel'])
            ->name('admin.movies');
        Route::delete('/{id}', [AdminMovieController::class, 'destroyMovie'])
            ->name('admin.movies.destroy');
        Route::get('/create', [AdminMovieController::class, 'showCreateMovie'])
            ->name('admin.movies.create');
        Route::post('/create', [AdminMovieController::class, 'createMovie'])
            ->name('admin.movies.create.save');
        Route::get('/{id}', [AdminMovieController::class, 'showMovieDetails'])
            ->name('admin.movies.show');
        Route::put('/{id}', [AdminMovieController::class, 'updateMovie'])
            ->name('admin.movies.update');
        Route::get('/{movieId}/removeDirector/{directorId}', [AdminMovieController::class, 'removeDirector'])
            ->name('admin.movies.removeDirector');
        Route::get('/{movieId}/addDirector/{directorId}', [AdminMovieController::class, 'addDirector'])
            ->name('admin.movies.addDirector');
        Route::get('/movies/{movieId}/searchDirectors', [AdminMovieController::class, 'searchDirectors'])
            ->name('admin.movies.searchDirectors');
        Route::get('/{movieId}/removeActor/{actorId}', [AdminMovieController::class, 'removeActor'])
            ->name('admin.movies.removeActor');
        Route::get('/{movieId}/addActor/{actorId}', [AdminMovieController::class, 'addActor'])
            ->name('admin.movies.addActor');
        Route::get('/{movieId}/searchActors', [AdminMovieController::class, 'searchActors'])
            ->name('admin.movies.searchActors');
        Route::put('/{id}/updateGenres', [AdminMovieController::class, 'updateGenres'])
            ->name('admin.movies.updateGenres');
        Route::put('/{id}/updateStreamingServices', [AdminMovieController::class, 'updateStreamingServices'])
            ->name('admin.movies.updateStreamingServices');
        Route::put('/movies/{id}/updateCountries', [AdminMovieController::class, 'updateCountries'])
            ->name('admin.movies.updateCountries');
        Route::get('/{movieId}/searchCountries', [AdminMovieController::class, 'searchCountries'])
            ->name('admin.movies.searchCountries');
        Route::get('/{movieId}/removeCountry/{countryId}', [AdminMovieController::class, 'removeCountry'])
            ->name('admin.movies.removeCountry');
        Route::get('/{movieId}/addCountry/{countryId}', [AdminMovieController::class, 'addCountry'])
            ->name('admin.movies.addCountry');
    });

    Route::prefix('/directors')->group(function () {
        Route::get('/', [AdminDirectorController::class, 'showDirectorsAdminPanel'])
            ->name('admin.directors');
        Route::delete('/{id}', [AdminDirectorController::class, 'destroyDirector'])
            ->name('admin.directors.destroy');
        Route::put('/{id}', [AdminDirectorController::class, 'updateDirector'])
            ->name('admin.directors.update');
        Route::get('/create', [AdminDirectorController::class, 'showCreateDirector'])
            ->name('admin.directors.create');
        Route::post('/create', [AdminDirectorController::class, 'createDirector'])
            ->name('admin.directors.create.save');
    });

    Route::prefix('/actors')->group(function () {
        Route::get('/', [AdminActorController::class, 'showActorsAdminPanel'])
            ->name('admin.actors');
        Route::delete('/{id}', [AdminActorController::class, 'destroyActor'])
            ->name('admin.actors.destroy');
        Route::put('/{id}', [AdminActorController::class, 'updateActor'])
            ->name('admin.actors.update');
        Route::get('/create', [AdminActorController::class, 'showCreateActor'])
            ->name('admin.actors.create');
        Route::post('/create', [AdminActorController::class, 'createActor'])
            ->name('admin.actors.create.save');
    });

    Route::prefix('/reports')->group(function () {
        Route::get('/', [AdminReportController::class, 'showReportsAdminPanel'])
            ->name('admin.reports');
        Route::post('/resolve/{id}', [AdminReportController::class, 'resolveReport'])
            ->name('reports.resolve');
    });
});
