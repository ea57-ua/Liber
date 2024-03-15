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
}
