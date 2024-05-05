<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $johndoe = User::where('email', 'johndoe@gmail.com')->first();
        $nicole = User::where('email', 'stuart@gmail.com')->first();
        $juan = User::where('email', 'juan@gmail.com')->first();
        $vladimir = User::where('email', 'vlad@gmail.com')->first();
        $jessica = User::where('email', 'jessica@gmail.com')->first();

        $dune1 = Movie::where('title', 'Dune')->first();
        $dune2 = Movie::where('title', 'Dune: Part Two')->first();
        $enemy = Movie::where('title', 'Enemy')->first();
        $nocountry = Movie::where('title', 'No Country for old men')->first();
        $seven = Movie::where('title', 'Seven')->first();
        $pulpfiction = Movie::where('title', 'Pulp Fiction')->first();

        // Reviews
        $this->createReview($johndoe, $dune1, 'Great movie! Really enjoyed it.');
        $this->createReview($nicole, $dune1, 'Not my cup of tea, but well made.');
        $this->createReview($juan, $dune1, '¡Gran película! Realmente lo disfruté.');
        $this->createReview($vladimir, $dune1, 'No es lo mío, pero está bien hecha.');

        $this->createReview($jessica, $dune2, 'Better than the first part!');
        $this->createReview($johndoe, $dune2, 'Mejor que la primera parte!');
        $this->createReview($nicole, $dune2, 'A bit disappointing after the first part.');
        $this->createReview($juan, $dune2, 'Un poco decepcionante después de la primera parte.');

        $this->createReview($vladimir, $enemy, 'A masterpiece of suspense and mystery.');
        $this->createReview($jessica, $enemy, 'Una obra maestra de suspense y misterio.');
        $this->createReview($johndoe, $enemy, 'Too confusing for me.');
        $this->createReview($nicole, $enemy, 'Demasiado confuso para mí.');

        $this->createReview($juan, $nocountry, 'A classic. Everyone should watch this.');
        $this->createReview($vladimir, $nocountry, 'Un clásico. Todo el mundo debería ver esto.');
        $this->createReview($jessica, $nocountry, 'I found it a bit slow.');
        $this->createReview($johndoe, $nocountry, 'Lo encontré un poco lento.');

        $this->createReview($nicole, $seven, 'Dark and gripping. A must watch.');
        $this->createReview($juan, $seven, 'Oscuro y cautivador. Debes verlo.');
        $this->createReview($vladimir, $seven, 'Too dark for my taste.');
        $this->createReview($jessica, $seven, 'Demasiado oscuro para mi gusto.');

        $this->createReview($johndoe, $pulpfiction, 'Quirky and fun. Loved it!');
        $this->createReview($nicole, $pulpfiction, 'Excéntrico y divertido. ¡Me encantó!');
        $this->createReview($juan, $pulpfiction, 'Not as good as Tarantino\'s other films.');
        $this->createReview($vladimir, $pulpfiction, 'No tan bueno como las otras películas de Tarantino.');
    }

    private function createReview($user, $movie, $content){
        $review = new Review();
        $review->user_id = $user->id;
        $review->movie_id = $movie->id;
        $review->text = $content;
        $review->save();
    }
}
