<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class MovieDTO
{
    private string $title;
    private string $director;
    private string $posterUrl;
    private string $synopsis;
    private string $genre;
    private int $year;
    private int $duration;
    private string $country;
    private float $rating;

    private ?UploadedFile $poster;

    public function __construct()
    {
        $this->title = '';
        $this->director = '';
        $this->posterUrl = '';
        $this->synopsis = '';
        $this->genre = '';
        $this->year = 0;
        $this->duration = 0;
        $this->country = '';
        $this->rating = 0.0;
        $this->poster = null;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDirector(string $director)
    {
        $this->director = $director;
    }

    public function setPosterUrl(string $posterUrl)
    {
        $this->posterUrl = $posterUrl;
    }

    public function setSynopsis(string $synopsis)
    {
        $this->synopsis = $synopsis;
    }

    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }

    public function setYear(int $year)
    {
        $this->year = $year;
    }

    public function setDuration(int $duration)
    {
        $this->duration = $duration;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function setRating(float $rating)
    {
        $this->rating = $rating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setPoster($image)
    {
        $this->poster = $image;
    }

    public function getPoster(): ?UploadedFile
    {
        return $this->poster;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }

    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

}
