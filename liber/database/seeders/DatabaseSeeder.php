<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\CriticRequestState;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DirectorsSeeder::class,
            ActorsSeeder::class,
            MoviesTableSeeder::class,
            UsersTableSeeder::class,
            ForumSeeder::class,
            ReviewsSeeder::class,
            RatingsTableSeeder::class,
            MovieListsSeeder::class,
            ChatsSeeder::class,
            CriticRequestsSeeder::class,
            PostReportsSeeder::class,
            FollowersSeeder::class,
        ]);
    }
}
