<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function showActorInfo($id)
    {
        $actor = Actor::findOrfail($id);
        $movies = $actor->movies()->get();
        $averageRatingGlobal = $movies->avg(function ($movie) {
            return $movie->getAverageRatingAttribute();
        });

        $averageRatingCritics = $movies->avg(function ($movie) {
            return $movie->getCriticAverageAttribute();
        });

        return view('actors.actorDetails', [
            'actor' => $actor,
            'movies' => $movies,
            'averageRatingGlobal' => $averageRatingGlobal,
            'averageRatingCritics' => $averageRatingCritics]);
    }
}
