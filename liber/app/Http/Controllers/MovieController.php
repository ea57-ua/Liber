<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function moviesPage()
    {
        $movies = Movie::paginate(3);
        return view('movies.moviesPage', ['movies' => $movies]);
    }

    public function showMovieInfo($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.movieInfo', ['movie' => $movie]);
    }
}
