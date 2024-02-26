<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'release_date',
        'posterURL',
        'synopsis',
    ];

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'movie_director');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'movie_country');
    }

    public function ratedMovies()
    {
        return $this->belongsToMany(Movie::class, 'ratings')->withPivot('rating');
    }
}
