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
        $users = [
            User::where('email', 'user@liber.com')->first(),
            User::where('email', 'critic@liber.com')->first(),
            User::where('email', 'admin@liber.com')->first(),
            User::where('email', 'johndoe@gmail.com')->first(),
            User::where('email', 'stuart@gmail.com')->first(),
            User::where('email', 'juan@gmail.com')->first(),
            User::where('email', 'vlad@gmail.com')->first(),
            User::where('email', 'jessica@gmail.com')->first()
        ];

        $movies = [
            Movie::where('title', 'Dune')->first(),
            Movie::where('title', 'Dune: Part Two')->first(),
            Movie::where('title', 'Enemy')->first(),
            Movie::where('title', 'No Country for old men')->first(),
            Movie::where('title', 'Seven')->first(),
            Movie::where('title', 'Pulp Fiction')->first(),
            Movie::where('title', 'Big Lebowski')->first(),
            Movie::where('title', 'Casino')->first(),
            Movie::where('title', 'Django Unchained')->first(),
            Movie::where('title', 'Oppenheimer')->first()
        ];

        foreach ($users as $user) {
            foreach ($movies as $movie) {
                if (rand(1, 10) <= 7) {
                    $this->createRating($user, $movie, rand(70, 100) / 10);
                }
            }
        }

    }

    private function createRating($user, $movie, $rating)
    {
        Rating::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => $rating,
        ]);
    }
}
