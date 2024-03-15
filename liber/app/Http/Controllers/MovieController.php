<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MoviesService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $moviesService;

    public function __construct()
    {
        $this->moviesService = new MoviesService();
    }
    public function moviesPage(Request $request)
    {
        $movies = $this->moviesService->getMoviesList();
        if(collect($request->all())->filter()->isNotEmpty()){
            $movies = $this->filterMovies($request, $movies);
        }
        $movies = $movies->paginate(2)->withQueryString();
        $countries = $this->moviesService->getCountriesWithMovies();
        $genres = $this->moviesService->getGenresList();
        $years = $this->moviesService->getMoviesReleaseYears();
        return view('movies.moviesPage',
            ['movies' => $movies, 'countries' => $countries,
                'genres' => $genres, 'years' => $years]);
    }

    public function showMovieInfo($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.movieInfo', ['movie' => $movie]);
    }

    private function filterMovies($request, $movies) {
        if ($movies == null) {
            $movies = $this->moviesService->getMoviesList();
        }

        if($request->has('movie-title') && $request->input('movie-title') != '') {
            $movies = $movies->where('title', 'LIKE', '%' . $request->input('movie-title') . '%');
        }

        if($request->has('release-year') && $request->input('release-year') != '') {
            $movies = $movies->whereYear('releaseDate', $request->input('release-year'));
        }

        if($request->has('country') && $request->input('country') != '') {
            $movies = $movies->whereHas('countries', function ($query) use ($request) {
                $query->where('countries.id', $request->input('country'));
            });
        }

        if($request->has('genre') && $request->input('genre') != '') {
            $movies = $movies->whereHas('genres', function ($query) use ($request) {
                $query->where('genres.id', $request->input('genre'));
            });
        }

        return $movies;
    }
}
