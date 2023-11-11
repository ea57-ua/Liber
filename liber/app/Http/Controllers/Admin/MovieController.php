<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function showMoviesAdminPanel(Request $request)
    {
        $movies = Movie::paginate(5);
        return view('admin.movies.movies', ['movies' => $movies]);
    }
}
