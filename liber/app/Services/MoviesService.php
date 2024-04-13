<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\StreamingService;
use Carbon\Carbon;

class MoviesService{
    public function getMoviesList(){
        return Movie::query();
    }

    public function getCountriesWithMovies(){
        return Country::whereHas('movies')->get();
    }

    public function getGenresList(){
        return Genre::all();
    }

    public function getMoviesReleaseYears(){
        $oldestYear = Carbon::parse(Movie::min('releaseDate'))->year;
        $newestYear = Carbon::parse(Movie::max('releaseDate'))->year;
        $years = range($oldestYear, $newestYear);
        return $years;
    }

    public function getStreamingServicesList(){
        return StreamingService::all();
    }

    public function getRelatesMoviesList($id){
        $movie = Movie::findOrFail($id);
        $directors = $movie->directors->pluck('id');
        $genres = $movie->genres->pluck('id');

        $relatedMovies = Movie::where(function ($query) use ($directors, $genres) {
            $query->whereHas('directors', function ($query) use ($directors) {
                $query->whereIn('directors.id', $directors);
            })
                ->orWhereHas('genres', function ($query) use ($genres) {
                    $query->whereIn('genres.id', $genres);
                });
        })
        ->where('movies.id', '!=', $id)
        ->get()->take(6);

        $relatedMovies = $relatedMovies->sortByDesc(function ($relatedMovie) use ($directors, $genres) {
            $matchingDirectors = $relatedMovie->directors->whereIn('id', $directors)->count();
            $matchingGenres = $relatedMovie->genres->whereIn('id', $genres)->count();
            return $matchingDirectors + $matchingGenres;
        });

        return $relatedMovies;
    }
}
