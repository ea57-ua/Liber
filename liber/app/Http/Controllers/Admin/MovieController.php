<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService();
    }
    public function showMoviesAdminPanel(Request $request)
    {
        $movies = Movie::paginate(5);
        return view('admin.movies.movies', ['movies' => $movies]);
    }

    public function showCreateMovie(Request $request)
    {
        return view('admin.movies.createMovieForm');
    }

    public function destroyMovie($id)
    {
        $this->movieService->deleteMovie($id);
        return redirect()->route('admin.movies');
    }
}
