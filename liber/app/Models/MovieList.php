<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'poster_image',
        'user_id',
        'watchlist',
        'public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'list_movies');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_movie_list_likes');
    }
}
