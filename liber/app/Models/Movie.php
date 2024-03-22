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

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getCriticAverageAttribute()
    {
        return $this->ratings()->with('user')->whereHas('user', function ($query) {
            $query->where('critic', true);
        })->avg('rating');
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    public function streamingServices()
    {
        return $this->belongsToMany(StreamingService::class, 'movie_streaming_service');
    }

    public function watchedByUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function movieLists()
    {
        return $this->belongsToMany(MovieList::class, 'list_movies');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
