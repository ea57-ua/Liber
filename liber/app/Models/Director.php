<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_director');
    }
}
