<?php

namespace App\Services;

use App\Models\Movie;

class MovieService
{
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
    }

    public function createMovie($movieDto)
    {
        $movie = new Movie();
        $movie->title = $movieDto->getTitle();
        $movie->director = $movieDto->getDirector();
        $movie->synopsis = $movieDto->getSynopsis();
        $movie->genre = $movieDto->getGenre();
        $movie->year = $movieDto->getYear();
        $movie->duration = $movieDto->getDuration();
        $movie->country = $movieDto->getCountry();
        $movie->rating = $movieDto->getRating();
        $movie->poster_url = $movieDto->getPosterUrl();
        $movie->save();

        if ($movieDto->getPosterUrl() != null) {
            $this->addPosterToMovie($movie->id, $movieDto->getPosterUrl());
        }
    }

    public function addPosterToMovie($id, $getPosterUrl)
    {
        //TODO: implement
    }

    public function getMovieById($id)
    {
        $movie = Movie::findOrFail($id);
        return $movie;
    }

    public function getMovies()
    {
        $movies = Movie::all();
        return $movies;
    }

    public function editMovie($id, $movieDto)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->title != $movieDto->getTitle()) {
            $movie->title = $movieDto->getTitle();
        }
        if ($movie->director != $movieDto->getDirector()) {
            $movie->director = $movieDto->getDirector();
        }
        if ($movie->synopsis != $movieDto->getSynopsis()) {
            $movie->synopsis = $movieDto->getSynopsis();
        }
        if ($movie->genre != $movieDto->getGenre()) {
            $movie->genre = $movieDto->getGenre();
        }
        if ($movie->year != $movieDto->getYear()) {
            $movie->year = $movieDto->getYear();
        }
        if ($movie->duration != $movieDto->getDuration()) {
            $movie->duration = $movieDto->getDuration();
        }
        if ($movie->country != $movieDto->getCountry()) {
            $movie->country = $movieDto->getCountry();
        }
        if ($movie->rating != $movieDto->getRating()) {
            $movie->rating = $movieDto->getRating();
        }

        if($movieDto->getPosterUrl() != null && $movieDto->getPosterUrl() != $movie->poster_url){
            $this->addPosterToMovie($movie->id, $movieDto->getPosterUrl());
        }
        $movie->save();
    }
}
