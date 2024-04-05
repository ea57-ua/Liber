<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $popularMovies = Movie::all()
            ->sortByDesc(function ($movie) {
                return [$movie->watchedByUsers()->count(), $movie->getAverageRatingAttribute()];
            })
            ->take(4);
        // TODO: Add a way to get the most popular movies

        $popularLists = MovieList::all()
            ->take(4);
        // TODO: Add a way to get the most popular lists

        return view('welcome', ['popularMovies' => $popularMovies, 'popularLists' => $popularLists]);
    }
}
