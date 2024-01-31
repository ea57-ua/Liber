<?php

namespace App\Http\Controllers\Admin;

use App\DTO\MovieDTO;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieService;

    private $rules = [
        'title' => 'required|max:255',
        'synopsis' => 'max:500',
        'director' => 'required|max:255',
        'year' => 'required|integer|between:1900,2050',
        'duration' => 'integer',
        'genre' => 'max:255',
        'country' => 'max:255',
        'rating' => 'decimal:0,2|between:0,10',
        'image' => 'image|mimes:png,jpeg,jpg|max:2048',
    ];
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

    public function createMovie(Request $request)
    {
        request()->validate($this->rules);
        $this->movieService->createMovie($this->getMovieFromRequest($request));
        return redirect()->route('admin.movies');
    }

    public function destroyMovie($id)
    {
        $this->movieService->deleteMovie($id);
        return redirect()->route('admin.movies');
    }

    public function getMovieFromRequest(Request $request) : MovieDTO
    {
        $movieDTO = new MovieDTO();

        if (request()->input('title')) {
            $movieDTO->setTitle($request->input('title'));
        }

        if (request()->input('synopsis')) {
            $movieDTO->setSynopsis($request->input('synopsis'));
        }

        if(request()->input('director')) {
            $movieDTO->setDirector($request->input('director'));
        }

        if(request()->input('year')) {
            $movieDTO->setYear($request->input('year'));
        }

        if(request()->input('duration')) {
            $movieDTO->setDuration($request->input('duration'));
        }

        if(request()->input('genre')) {
            $movieDTO->setGenre($request->input('genre'));
        }

        if(request()->input('country')) {
            $movieDTO->setCountry($request->input('country'));
        }

        if(request()->input('rating')) {
            $movieDTO->setRating($request->input('rating'));
        }

        if($request->has('image')) {
            $movieDTO->setPoster($request->image);
        }
        return $movieDTO;
    }
}
