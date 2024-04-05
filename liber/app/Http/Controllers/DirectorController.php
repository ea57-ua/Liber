<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function showDirectorInfo($id)
    {
        $director = Director::findOrfail($id);
        $movies = $director->movies()->get();
        $averageRatingGlobal = $movies->avg(function ($movie) {
            return $movie->getAverageRatingAttribute();
        });
        $averageRatingCritics = $movies->avg(function ($movie) {
            return $movie->getCriticAverageAttribute();
        });
        return view('directors.directorDetails',
            ['director' => $director,
                'movies' => $movies,
                'averageRatingGlobal' => $averageRatingGlobal,
                'averageRatingCritics' => $averageRatingCritics]);
    }
}
