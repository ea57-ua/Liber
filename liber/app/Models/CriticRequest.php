<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriticRequest extends Model
{
    use HasFactory;

    protected $table = 'critics_requests';

    protected $fillable = [
        'title',
        'description',
        'file',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
