<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('name', 'User 1')->first();
        $user2 = User::where('name', 'User 2')->first();
        $dune = Movie::where('title', 'Dune')->first();

        if ($user1 && $user2 && $dune) {
            Rating::create([
                'user_id' => $user1->id,
                'movie_id' => $dune->id,
                'rating' => 10,
            ]);

            Rating::create([
                'user_id' => $user2->id,
                'movie_id' => $dune->id,
                'rating' => 7,
            ]);
        }
    }
}
