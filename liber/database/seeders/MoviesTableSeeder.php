<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'The Shawshank Redemption',
                'director' => 'Frank Darabont',
                'synopsis' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'genre' => 'Drama',
                'year' => 1994,
                'duration' => 142,
                'country' => 'USA',
                'rating' => 9.3,
            ],
            [
                'title' => 'The Godfather',
                'director' => 'Francis Ford Coppola',
                'synopsis' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'genre' => 'Crime',
                'year' => 1972,
                'duration' => 175,
                'country' => 'USA',
                'rating' => 9.2,
            ],
            [
                'title' => 'The Dark Knight',
                'director' => 'Christopher Nolan',
                'synopsis' => 'When the menace known as The Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.',
                'genre' => 'Action',
                'year' => 2008,
                'duration' => 152,
                'country' => 'USA',
                'rating' => 9.0,
            ],
            [
                'title' => 'Pulp Fiction',
                'director' => 'Quentin Tarantino',
                'synopsis' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'genre' => 'Crime',
                'year' => 1994,
                'duration' => 154,
                'country' => 'USA',
                'rating' => 8.9,
            ],
            [
                'title' => 'Schindler\'s List',
                'director' => 'Steven Spielberg',
                'synopsis' => 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce.',
                'genre' => 'Biography',
                'year' => 1993,
                'duration' => 195,
                'country' => 'USA',
                'rating' => 8.9,
            ],

        ];

        // Insertar películas en la base de datos
        foreach ($movies as $movieData) {
            $movie = new Movie($movieData);
            $movie->save();
        }
    }
}
