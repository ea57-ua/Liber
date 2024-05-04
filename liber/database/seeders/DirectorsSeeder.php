<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  , fincher, tarantino,
        $this->createDirector("Denis Villeneuve",
            "Denis Villeneuve is a Canadian film director, writer, and producer. He is a four-time recipient of the Canadian Screen Award for Best Direction, for Maelström in 2001, Polytechnique in 2009, Incendies in 2010, and Enemy in 2013.",
            "https://i0.wp.com/www.bostonherald.com/wp-content/uploads/2024/02/BHR-L-DENIS-01_eceabb.jpg?fit=620%2C9999px&ssl=1"
        );

        $this->createDirector("Martin Scorsese",
            "Martin Scorsese is an American film director, producer, screenwriter, and actor. One of the major figures of the New Hollywood era, he is widely regarded as one of the greatest directors in the history of cinema.",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe83sDP4WW7jcqrD5ZYkrIU7sXkMhNNdOuV253ecuvAA&s"
        );

        $this->createDirector("Christopher Nolan",
            "Christopher Nolan is a British-American film director, producer, and screenwriter. His directorial efforts have grossed more than $5 billion worldwide, garnered 36 Oscar nominations and ten wins.",
            "https://www.otroscines.com/images/fotos/nolan-oscar-2024.jpg"
        );

        $this->createDirector("Coen Brothers",
            "The Coen Brothers are American filmmakers Joel Coen and Ethan Coen. Their films span many genres and styles, which they frequently subvert or parody. Their best-known works include Raising Arizona, Fargo, The Big Lebowski, etc",
        'https://www.indiewire.com/wp-content/uploads/2021/08/coen-brothers.png'
        );

        $this->createDirector("David Fincher",
            "David Fincher is an American film director. Known for his meticulous eye for detail and perfectionist tendencies, Fincher has garnered a reputation as a filmmaker who is obsessed with the filmmaking process.",
            "https://es.web.img3.acsta.net/medias/nmedia/18/64/19/48/19965756.jpg"
        );

        $this->createDirector("Quentin Tarantino",
            "Quentin Tarantino is an American film director, screenwriter, producer, and actor. His films are characterized by nonlinear storylines, satirical subject matter, an aestheticization of violence, extended scenes of dialogue, ensemble casts, references to popular culture, soundtracks primarily containing songs and score pieces from the 1960s to the 1980s, and features of neo-noir film.",
            "https://upload.wikimedia.org/wikipedia/commons/0/0b/Quentin_Tarantino_by_Gage_Skidmore.jpg"
        );
    }

    private function createDirector($name, $description, $imageURL){

        Director::where('name', $name)->delete();

        return Director::create([
            'name' => $name,
            'description' => $description,
            'photo' => $imageURL
        ]);
    }
}
