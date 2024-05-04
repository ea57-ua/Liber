<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\StreamingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Symfony\Component\Translation\t;

class MoviesTableSeeder extends Seeder
{
    public function run(): void
    {
        $dune = $this->createMovie('Dune','2021-10-22',
            'https://m.media-amazon.com/images/I/61YsswH6vQL._AC_UF894,1000_QL80_.jpg',
    '"Dune" follows young Paul Atreides as his family assumes control of the desert planet Arrakis. Amidst political intrigue and a valuable spice called melange, Paul navigates power struggles, betrayal, and a prophetic destiny in a universe marked by intrigue and danger.',
            'https://wallpapers.com/images/featured/dune-2021-background-2yyippe8lrbs2ms8.jpg',
            'https://youtu.be/n9xhJrPXop4?si=K6W44DPa5nzinuqi'
        );

        $dune2 = $this->createMovie('Dune: Part Two','2024-03-15',
            'https://sm.ign.com/ign_es/photo/d/dune-part-/dune-part-two-exclusive-new-poster-features-its-stellar-cast_aynf.jpg',
        'In Dune: Part Two, Paul Atreides allies with the Fremen, vowing vengeance for his family. Embracing their culture, he trains as a warrior and falls for Chani. Together, they confront the Harkonnens in a war, with Paul navigating a future shaped by his unique visions.',
            'https://images.hdqwalls.com/wallpapers/dune-part-2-2024-hc.jpg',
            'https://youtu.be/U2Qp5pL3ovA?si=bVv2dzc4O1tkOs3r'
        );

        $enemy = $this->createMovie('Enemy','2013-02-28',
            'https://hips.hearstapps.com/es.h-cdn.co/fotoes/images/noticias/exclusiva-primer-cartel-oficial-de-enemy/6844012-1-esl-ES/Exclusiva-Primer-cartel-oficial-de-Enemy.jpg',
            "\"Enemy\" follows Adam Bell, a professor obsessed with his doppelgänger, Anthony Claire. Their entangled lives lead to a surreal journey probing identity and reality. Blurred lines culminate in a chilling climax, leaving viewers questioning their true connection.",
            'https://w.forfun.com/fetch/9e/9e071690472ee7b5cbc9d97f34b9d51f.jpeg',
            'https://youtu.be/FJuaAWrgoUY?si=-RBbbq6GQVvHFw9c'
        );

        $lebowski = $this->createMovie('Big Lebowski','1998-04-14',
            'https://m.media-amazon.com/images/I/A1Le+AaKcPL._AC_UF1000,1000_QL80_.jpg',
            "Jeff 'The Dude' Leboswki is mistaken for Jeffrey Lebowski, who is The Big Lebowski. Which explains why he's roughed up and has his precious rug peed on. In search of recompense, The Dude tracks down his namesake, who seeks compensation for his ruined rug. He enlists his bowling buddies to help get it.",
            'https://images7.alphacoders.com/818/818014.jpg',
            'https://youtu.be/9fIWtaK1QLQ?si=hGuQ9JJ_dvwlxucK'
        );

        $nocountry = $this->createMovie('No Country for Old Men','2007-11-21',
            'https://m.media-amazon.com/images/M/MV5BMjA5Njk3MjM4OV5BMl5BanBnXkFtZTcwMTc5MTE1MQ@@._V1_FMjpg_UX1000_.jpg',
        'In rural Texas, welder Llewelyn Moss discovers a drug deal gone awry, taking two million dollars for himself. This sparks a deadly pursuit by psychopathic killer Anton Chigurh. As Sheriff Ed Tom Bell investigates, the hunt intensifies, leading to a chilling confrontation.',
            'https://wallpapercave.com/wp/wp2466090.jpg',
            'https://youtu.be/38A__WT3-o0?si=t1IWfduyKt7netXs'
        );

        $casino = $this->createMovie('Casino','1996-02-19',
            'https://m.media-amazon.com/images/M/MV5BMTcxOWYzNDYtYmM4YS00N2NkLTk0NTAtNjg1ODgwZjAxYzI3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg',
            'Martin Scorsese\'s film explores the dual nature of Las Vegas through mobsters Ace Rothstein and Nicky Santoro. Ace runs the Tangiers casino smoothly, while Nicky resorts to violence and crime. Their contrasting paths lead to tragic consequences fueled by love, addiction, and betrayal.',
            'https://image.tmdb.org/t/p/original/iZGiMD0p1M2AOmzKknFo5bkuz94.jpg',
            'https://youtu.be/j-D0QiMpGKc?si=_-yqFkYPd0jvnqpX'
        );

        $seven = $this->createMovie('Seven','1999-01-10',
            'https://m.media-amazon.com/images/M/MV5BOTUwODM5MTctZjczMi00OTk4LTg3NWUtNmVhMTAzNTNjYjcyXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg',
            "A film about two homicide detectives' desperate hunt for a serial killer who justifies his crimes as absolution for the world's ignorance of the Seven Deadly Sins. The movie takes us from the tortured remains of one victim to the next as the sociopathic 'John Doe' sermonizes to Detectives Somerset and Mills -- one sin at a time.",
            'https://wallpapercave.com/wp/wp2180119.jpg',
        'https://youtu.be/znmZoVkCjpI?si=EoeVquergpdk2kzU'
        );

        $django = $this->createMovie('Django Unchained','2013-01-18',
            'https://m.media-amazon.com/images/I/81IVfnsVtIL._AC_UF1000,1000_QL80_.jpg',
    'The freed slave Django and bounty hunter Dr. King Schultz embark on a mission to rescue Django\'s wife from a cruel plantation owner. Their journey through the South confronts slavery\'s horrors, delves into revenge, and explores the pursuit of freedom in a morally complex landscape.',
            'https://images2.alphacoders.com/112/1121054.jpg',
            'https://youtu.be/0fUCuvNlOCg?si=fzAmuWK7Wm6v4KdK'
        );

        $pulpfiction = $this->createMovie('Pulp Fiction','1995-01-13',
            'https://m.media-amazon.com/images/S/pv-target-images/dbb9aff6fc5fcd726e2c19c07f165d40aa7716d1dee8974aae8a0dad9128d392.jpg',
    'Hitmen Jules Winnfield and Vincent Vega seek a stolen suitcase for mob boss Marsellus Wallace. Vincent must also entertain Wallace\'s wife, Mia. Meanwhile, boxer Butch Coolidge is paid to throw a fight. Their lives intertwine in a series of darkly comedic and unpredictable events.',
            'https://images7.alphacoders.com/693/693715.jpg',
            'https://youtu.be/s7EdQ4FqbhY?si=rDD89knbwy0ustms'
        );

        $oppenheimer = $this->createMovie('Oppenheimer','2023-07-21',
            'https://m.media-amazon.com/images/M/MV5BMDBmYTZjNjUtN2M1MS00MTQ2LTk2ODgtNzc2M2QyZGE5NTVjXkEyXkFqcGdeQXVyNzAwMjU2MTY@._V1_FMjpg_UX1000_.jpg',
        'Oppenheimer is a biographical drama depicting J. Robert Oppenheimer\'s leadership in the Manhattan Project. The film explores his moral dilemmas, personal relationships, and the profound impact of his work on the atomic age and beyond.',
            'https://images7.alphacoders.com/131/1314905.jpeg',
            'https://youtu.be/uYPbbksJxIg?si=xCgc_HGqxIIO8PIb'
        );

        // Directors section
        $villeneuve = Director::where('name', 'Denis Villeneuve')->first();
        $scorsese = Director::where('name', 'Martin Scorsese')->first();
        $coenBrothers = Director::where('name', 'Coen Brothers')->first();
        $fincher = Director::where('name', 'David Fincher')->first();
        $tarantino = Director::where('name', 'Quentin Tarantino')->first();
        $nolan = Director::where('name', 'Christopher Nolan')->first();

        $dune->directors()->attach($villeneuve);
        $dune2->directors()->attach($villeneuve);
        $enemy->directors()->attach($villeneuve);
        $lebowski->directors()->attach($coenBrothers);
        $nocountry->directors()->attach($coenBrothers);
        $casino->directors()->attach($scorsese);
        $seven->directors()->attach($fincher);
        $django->directors()->attach($tarantino);
        $pulpfiction->directors()->attach($tarantino);
        $oppenheimer->directors()->attach($nolan);

        // Genres asignation section
        $scifiGenre = Genre::where('name', 'Sci-Fi')->first();
        $thrillerGenre = Genre::where('name', 'Thriller')->first();
        $adventure = Genre::where('name', 'Adventure')->first();
        $biography = Genre::where('name', 'Biography')->first();
        $crimeGenre = Genre::where('name', 'Crime')->first();
        $western = Genre::where('name', 'Western')->first();
        $comedy = Genre::where('name', 'Comedy')->first();
        $history = Genre::where('name', 'History')->first();
        $action = Genre::where('name', 'Action')->first();
        $mystery = Genre::where('name', 'Mystery')->first();
        $fantasy = Genre::where('name', 'Fantasy')->first();

        $dune->genres()->attach($scifiGenre);
        $dune->genres()->attach($adventure);
        $dune2->genres()->attach($fantasy);

        $dune2->genres()->attach($scifiGenre);
        $dune2->genres()->attach($adventure);
        $dune2->genres()->attach($fantasy);

        $enemy->genres()->attach($thrillerGenre);
        $enemy->genres()->attach($mystery);

        $lebowski->genres()->attach($comedy);
        $lebowski->genres()->attach($crimeGenre);

        $nocountry->genres()->attach($crimeGenre);
        $nocountry->genres()->attach($thrillerGenre);
        $nocountry->genres()->attach($western);

        $casino->genres()->attach($crimeGenre);
        $casino->genres()->attach($thrillerGenre);

        $seven->genres()->attach($crimeGenre);
        $seven->genres()->attach($thrillerGenre);
        $seven->genres()->attach($mystery);

        $django->genres()->attach($western);
        $django->genres()->attach($action);

        $pulpfiction->genres()->attach($crimeGenre);
        $pulpfiction->genres()->attach($thrillerGenre);

        $oppenheimer->genres()->attach($biography);
        $oppenheimer->genres()->attach($history);
        $oppenheimer->genres()->attach($thrillerGenre);

        // Countries  section
        $usa = Country::where('name', 'United States')->first();
        $canada = Country::where('name', 'Canada')->first();
        $spain = Country::where('name', 'Spain')->first();
        $uk = Country::where('name', 'United Kingdom')->first();
        $hungary = Country::where('name', 'Hungary')->first();
        $emirates = Country::where('name', 'United Arab Emirates')->first();

        $dune->countries()->attach($usa);
        $dune->countries()->attach($canada);
        $dune->countries()->attach($hungary);

        $dune2->countries()->attach($usa);
        $dune2->countries()->attach($canada);
        $dune2->countries()->attach($hungary);
        $dune2->countries()->attach($emirates);

        $enemy->countries()->attach($canada);
        $enemy->countries()->attach($spain);

        $lebowski->countries()->attach($usa);
        $nocountry->countries()->attach($usa);
        $casino->countries()->attach($usa);
        $seven->countries()->attach($usa);
        $django->countries()->attach($usa);
        $pulpfiction->countries()->attach($usa);

        $oppenheimer->countries()->attach($usa);
        $oppenheimer->countries()->attach($uk);

        // Streaming services section
        $hbo = StreamingService::where('name', 'HBO Max')->first();
        $netflix = StreamingService::where('name', 'Netflix')->first();
        $prime = StreamingService::where('name', 'Amazon Prime')->first();
        $appletv = StreamingService::where('name', 'Apple TV+')->first();
        $peacock = StreamingService::where('name', 'Peacock')->first();
        $dune->streamingServices()->attach($hbo);
        $dune->streamingServices()->attach($prime);
        $dune2->streamingServices()->attach($netflix);
        $enemy->streamingServices()->attach($netflix);
        $lebowski->streamingServices()->attach($prime);
        $nocountry->streamingServices()->attach($prime);
        $seven->streamingServices()->attach($hbo);
        $casino->streamingServices()->attach($appletv);
        $casino->streamingServices()->attach($prime);
        $pulpfiction->streamingServices()->attach($netflix);
        $oppenheimer->streamingServices()->attach($peacock);

        $zendaya = Actor::where('name', 'Zendaya')->first();
        $chalamet = Actor::where('name', 'Timothée Chalamet')->first();
        $gyllenhaal = Actor::where('name', 'Jake Gyllenhaal')->first();
        $javierbardem = Actor::where('name', 'Javier Bardem')->first();
        $johjbrolin = Actor::where('name', 'Josh Brolin')->first();
        $jeffbridges = Actor::where('name', 'Jeff Bridges')->first();
        $robertdeniro = Actor::where('name', 'Robert De Niro')->first();
        $bradpitt = Actor::where('name', 'Brad Pitt')->first();
        $freeman = Actor::where('name', 'Morgan Freeman')->first();
        $jamiefox = Actor::where('name', 'Jamie Fox')->first();
        $dicaprio = Actor::where('name', 'Leonardo DiCaprio')->first();
        $waltz = Actor::where('name', 'Christoph Waltz')->first();
        $samualljackson = Actor::where('name', 'Samuel L Jackson')->first();
        $umathurman = Actor::where('name', 'Uma Thurman')->first();
        $johntravolta = Actor::where('name', 'John Travolta')->first();
        $brucewillis = Actor::where('name', 'Bruce Willis')->first();
        $cyllianmurphy = Actor::where('name', 'Cyllian Murphy')->first();
        $emilyblunt = Actor::where('name', 'Emily Blunt')->first();

        $dune->actors()->attach($chalamet);
        $dune->actors()->attach($zendaya);
        $dune->actors()->attach($johjbrolin);
        $dune->actors()->attach($javierbardem);

        $dune2->actors()->attach($chalamet);
        $dune2->actors()->attach($zendaya);
        $dune2->actors()->attach($johjbrolin);
        $dune2->actors()->attach($javierbardem);

        $enemy->actors()->attach($gyllenhaal);

        $lebowski->actors()->attach($jeffbridges);

        $nocountry->actors()->attach($javierbardem);
        $nocountry->actors()->attach($johjbrolin);

        $casino->actors()->attach($robertdeniro);

        $seven->actors()->attach($bradpitt);
        $seven->actors()->attach($freeman);

        $django->actors()->attach($dicaprio);
        $django->actors()->attach($waltz);
        $django->actors()->attach($jamiefox);

        $pulpfiction->actors()->attach($samualljackson);
        $pulpfiction->actors()->attach($umathurman);
        $pulpfiction->actors()->attach($johntravolta);
        $pulpfiction->actors()->attach($brucewillis);

        $oppenheimer->actors()->attach($cyllianmurphy);
        $oppenheimer->actors()->attach($emilyblunt);
    }

    private function createMovie($title, $releaseDate, $posterURL, $synopsis, $backgroundImageLink, $trailerLink ): Movie
    {
        Movie::where('title', $title)->delete();

        return Movie::create([
            'title' => $title,
            'releaseDate' => $releaseDate,
            'posterURL' => $posterURL,
            'synopsis' => $synopsis,
            'background_image_link' => $backgroundImageLink,
            'trailer_link' => $trailerLink
        ]);
    }
}
