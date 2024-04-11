<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriticRequest extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'critics_requests';

    protected $fillable = [
        'title',
        'description',
        'file',
        'user_id',
        'state',
        'response'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
