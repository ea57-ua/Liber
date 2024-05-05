<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $johndoe = User::where('email', 'johndoe@gmail.com')->first();
        $nicole = User::where('email', 'stuart@gmail.com')->first();
        $juan = User::where('email', 'juan@gmail.com')->first();

        $dune1 = Movie::where('title', 'Dune')->first();
        $dune2 = Movie::where('title', 'Dune: Part Two')->first();
        $enemy = Movie::where('title', 'Enemy')->first();
        $nocountry = Movie::where('title', 'No Country for old men')->first();
        $seven = Movie::where('title', 'Seven')->first();
        $pulpfiction = Movie::where('title', 'Pulp Fiction')->first();
        $lebowski = Movie::where('title', 'Big Lebowski')->first();
        $casino = Movie::where('title', 'Casino')->first();
        $django = Movie::where('title', 'Django Unchained')->first();
        $oppenheimer = Movie::where('title', 'Oppenheimer')->first();


        $list1 = $this->createMovieList($johndoe, 'My favorite movies',
            'A list of my favorite movies', true, false,
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXYs2Wm53ejg2DUV1-dhtWoRhjiYvwj3veDGYkuoRZzg&s');
        $list1->movies()->attach([$dune1->id, $dune2->id, $oppenheimer->id]);
        $list1->movies()->attach([$enemy->id, $nocountry->id, $seven->id]);

        $list2 = $this->createMovieList($nicole, 'The best of Tarantino',
            'A list of the best movies directed by Quentin Tarantino', true, false,
            'https://w0.peakpx.com/wallpaper/590/843/HD-wallpaper-quentin-tarantino-movies-tarantino-movies.jpg');
        $list2->movies()->attach([$pulpfiction->id, $django->id]);

        $list3 = $this->createMovieList($juan, 'For a mood of suspense',
            'A list of movies for when you are in the mood for suspense',
            true, false,
            'https://w0.peakpx.com/wallpaper/316/580/HD-wallpaper-horror-movies.jpg');
        $list3->movies()->attach([$enemy->id, $seven->id]);


        $list4 = $this->createMovieList($johndoe, 'My top 5 movies',
            'A list of my top 5 favorite movies',
            true, false, 'https://i.pinimg.com/originals/13/12/13/1312131eaa6d336253a7fda97ef7b843.jpg');
        $list4->movies()->attach([$dune1->id, $dune2->id, $enemy->id, $nocountry->id, $seven->id]);

        $list5 = $this->createMovieList($nicole, 'Movies to watch on a rainy day',
            'A list of movies perfect for a rainy day', true, false,
            'https://lh6.googleusercontent.com/proxy/4YzP-MuH_kMqAU2MWflt7y-HDSwc7xKtKPJQC1nlZT-r9ID4SNR3BvaiHYt9rR8o_wL1yZWGNpP_Fch8g0I2DpyitTRXldqF69dkqrOuPhb3k0qD1fPL');
        $list5->movies()->attach([$pulpfiction->id, $django->id, $lebowski->id, $casino->id]);

        $list6 = $this->createMovieList($juan, 'My favorite sci-fi movies',
            'A list of my favorite science fiction movies',
            true, false, 'https://cdn.openart.ai/stable_diffusion/6e21a5b74de95c3c62304d07a2bc2db31d4e22d3_2000x2000.webp');
        $list6->movies()->attach([$dune1->id, $dune2->id, $oppenheimer->id]);

        $list7 = $this->createMovieList($johndoe, 'Movies to watch with friends',
            'A list of movies to watch with friends',
            true, false, 'https://i.pinimg.com/736x/0a/09/30/0a0930ed5062637f4a96091619930294.jpg');
        $list7->movies()->attach([$pulpfiction->id, $django->id, $lebowski->id, $casino->id]);

        $list8 = $this->createMovieList($nicole, 'Movies to watch with family',
            'A list of movies to watch with family',
            true, false, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsNxv3wjX6Sdj5xSLtZo0L2wkbMT_Rf1F8NjgUjh4_Tw&s');
        $list8->movies()->attach([$dune1->id, $dune2->id, $oppenheimer->id]);

        $list9 = $this->createMovieList($juan, 'Movies to watch alone',
            'A list of movies to watch alone',
            true, false, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS36llSixcjPI8lCC0DsgCH6t1C11GUb9qHANqTcVZ4rQ&s');
        $list9->movies()->attach([$enemy->id, $nocountry->id, $seven->id]);

        $list10 = $this->createMovieList($johndoe, 'Movies to watch with a date',
            'A list of movies to watch with a date',
            true, false, 'https://m.media-amazon.com/images/I/51TLcuInWXL._AC_UF894,1000_QL80_.jpg');
        $list10->movies()->attach([$pulpfiction->id, $django->id, $lebowski->id, $casino->id]);
    }

    private function createMovieList(
        User $user, string $name, string $description, bool $public,
        bool $watchlist, string $image): MovieList
    {
        MovieList::where('name', $name)->delete();

        return MovieList::create([
            'name' => $name,
            'description' => $description,
            'public' => $public,
            'watchlist' => $watchlist,
            'user_id' => $user->id,
            'poster_image' => $image,
        ]);
    }
}
