<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recommendedMovies = null;
        if(auth()->check()) {
            $recommendedMovies = Movie::all()->take(4);
        }

        $popularMovies = Movie::all()
            ->sortByDesc(function ($movie) {
                return [$movie->watchedByUsers()->count(), $movie->getAverageRatingAttribute()];
            })
            ->take(4);
        // TODO: Add a way to get the most popular movies

        $popularLists = MovieList::all()
            ->take(4);
        // TODO: Add a way to get the most popular lists

        return view('welcome', [
            'popularMovies' => $popularMovies,
            'popularLists' => $popularLists,
            'recommendedMovies' => $recommendedMovies]);
    }
}
