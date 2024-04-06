<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
        ['text', 'image1', 'image2', 'image3', 'image4', 'video', 'user_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }


    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
