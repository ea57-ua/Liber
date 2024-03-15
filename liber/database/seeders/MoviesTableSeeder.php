<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\StreamingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dune = Movie::create([
            'title' => 'Dune',
            'releaseDate' => '2021-09-15',
            'posterURL' => 'https://m.media-amazon.com/images/I/61YsswH6vQL._AC_UF894,1000_QL80_.jpg',
            'synopsis' => 'Feature adaptation of Frank Herbert\'s science fiction novel, about the son of a noble family entrusted with the protection of the most valuable asset and most vital element in the galaxy.',
        ]);
        $dune2 = Movie::create([
            'title' => 'Dune: Part Two',
            'releaseDate' => '2024-10-20',
            'posterURL' => 'https://sm.ign.com/ign_es/photo/d/dune-part-/dune-part-two-exclusive-new-poster-features-its-stellar-cast_aynf.jpg',
            'synopsis' => 'Feature adaptation of Frank Herbert\'s science fiction novel, about the son of a noble family entrusted with the protection of the most valuable asset and most vital element in the galaxy.',
        ]);
        $enemy = Movie::create([
            'title' => 'Enemy',
            'releaseDate' => '2013-09-08',
            'posterURL' => 'https://hips.hearstapps.com/es.h-cdn.co/fotoes/images/noticias/exclusiva-primer-cartel-oficial-de-enemy/6844012-1-esl-ES/Exclusiva-Primer-cartel-oficial-de-Enemy.jpg',
            'synopsis' => 'Fumada pelicula de un tipo que se encuentra a su doble y se obsesiona con el.',
        ]);

        $scifiGenre = Genre::where('name', 'Sci-Fi')->first();
        $thrillerGenre = Genre::where('name', 'Thriller')->first();

        $dune->genres()->attach($scifiGenre);
        $dune2->genres()->attach($scifiGenre);
        $enemy->genres()->attach($thrillerGenre);

        $usa = Country::where('name', 'United States')->first();
        $canada = Country::where('name', 'Canada')->first();
        $dune->countries()->attach($usa);
        $dune2->countries()->attach($usa);
        $enemy->countries()->attach($usa);
        $enemy->countries()->attach($canada);

        $hbo = StreamingService::where('name', 'HBO Max')->first();
        $netflix = StreamingService::where('name', 'Netflix')->first();
        $enemy->streamingServices()->attach($netflix);
        $dune->streamingServices()->attach($hbo);
    }
}
