<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{

    public function run(): void
    {
        $this->createActor('Zendaya',
            'Zendaya, an American actress and singer, captivates audiences with her versatility and charisma. Rising to fame in Disney\'s "Shake It Up," she gained critical acclaim for her role in HBO\'s "Euphoria." With a magnetic presence on-screen, Zendaya\'s performances are marked by emotional depth and authenticity, solidifying her as a dynamic talent in Hollywood\'s landscape.',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Zendaya_-_2019_by_Glenn_Francis.jpg/800px-Zendaya_-_2019_by_Glenn_Francis.jpg');
        $this->createActor('Timothée Chalamet',
            'Timothée Chalamet, a rising star in Hollywood, is known for his compelling performances and undeniable charm. With breakout roles in "Call Me by Your Name" and "Lady Bird," Chalamet has garnered widespread acclaim for his emotive portrayal of complex characters. His talent, coupled with his distinct presence, marks him as one of the most promising actors of his generation.',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Timoth%C3%A9e_Chalamet_2017_Berlinale.jpg/800px-Timoth%C3%A9e_Chalamet_2017_Berlinale.jpg');
        $this->createActor('Jake Gyllenhaal',
            'Jake Gyllenhaal is an American actor known for his roles in films like "Donnie Darko", "Brokeback Mountain", and "Nightcrawler".',
            'https://static.wikia.nocookie.net/doblaje/images/d/d2/MV5BNjA0MTU2NDY3MF5BMl5BanBnXkFtZTgwNDU4ODkzMzE%40._V1_.jpg/revision/latest?cb=20190131011010&path-prefix=es');
        $this->createActor('Javier Bardem',
            'Javier Bardem is a Spanish actor and environmental activist. He won the Academy Award for Best Supporting Actor for his role in "No Country for Old Men".',
            'https://m.media-amazon.com/images/M/MV5BMTY1NTc4NTYzMF5BMl5BanBnXkFtZTcwNDIwOTY1NA@@._V1_.jpg');
        $this->createActor('Josh Brolin',
            'Josh Brolin is an American actor known for his roles in "No Country for Old Men", "Avengers: Endgame", and "Deadpool 2".',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Josh_Brolin_SDCC_2014.jpg/1200px-Josh_Brolin_SDCC_2014.jpg');
        $this->createActor('Jeff Bridges',
            'Jeff Bridges, an iconic figure in Hollywood, is celebrated for his versatility and authenticity as an actor. With a career spanning decades, he has delivered memorable performances in films like "The Big Lebowski," "Crazy Heart," and "True Grit." Bridges\' commanding presence, coupled with his nuanced portrayal of characters, has solidified his status as a beloved and respected figure in the industry.',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Jeff_Bridges_by_Gage_Skidmore_3.jpg/1200px-Jeff_Bridges_by_Gage_Skidmore_3.jpg');
        $this->createActor('Robert De Niro',
            'Robert De Niro is an American actor, producer, and director. He is a recipient of numerous accolades, including two Academy Awards, a Golden Globe Award, the Cecil B. DeMille Award, and a Screen Actors Guild Life Achievement Award.',
            'https://cdn.britannica.com/00/213300-050-ADF31CD9/American-actor-Robert-De-Niro-2019.jpg');
        $this->createActor('Brad Pitt',
            'Brad Pitt is an American actor and film producer. He is known for his roles in big-budget productions and character-driven films, and for his collaborations with the director David Fincher.',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Brad_Pitt_2019_by_Glenn_Francis.jpg/800px-Brad_Pitt_2019_by_Glenn_Francis.jpg');
        $this->createActor('Morgan Freeman',
            'Morgan Freeman is an American actor, director and narrator. He has appeared in a range of film genres portraying character roles and is particularly known for his distinctive deep voice.',
            'https://m.media-amazon.com/images/M/MV5BMTc0MDMyMzI2OF5BMl5BanBnXkFtZTcwMzM2OTk1MQ@@._V1_FMjpg_UX1000_.jpg');
        $this->createActor('Jamie Fox',
            'Jamie Fox is a British actor, known for his roles in films such as "The Servant", "Performance", and "Thoroughly Modern Millie".',
            'https://m.media-amazon.com/images/M/MV5BMTkyNjY1NDg3NF5BMl5BanBnXkFtZTgwNjA2MTg0MzE@._V1_.jpg');
        $this->createActor('Leonardo DiCaprio',
            'Leonardo DiCaprio is an American actor, film producer, and environmental activist. He has been nominated for six Academy Awards, four British Academy Film Awards and nine Screen Actors Guild Awards, winning one of each award from them and three Golden Globe Awards from eleven nominations.',
            'https://image.gala.de/21407118/t/26/v6/w960/r0.6667/-/leonardo-dicaprio.jpg');
        $this->createActor('Christoph Waltz',
            'Waltz is an actor known for his roles in films directed by Quentin Tarantino. He won an Academy Award for his role in "Inglourious Basterds".',
            'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/171314_v9_bb.jpg');
        $this->createActor('Samuel L Jackson',
            'Samuel L Jackson is an American actor and producer. He achieved prominence and critical acclaim in the early 1990s with films such as "Goodfellas", "Jungle Fever", "Patriot Games", "Amos & Andrew", "True Romance", and "Jurassic Park".',
            'https://m.media-amazon.com/images/M/MV5BMTQ1NTQwMTYxNl5BMl5BanBnXkFtZTYwMjA1MzY1._V1_FMjpg_UX1000_.jpg');
        $this->createActor('Uma Thurman',
            'Uma Thurman is an American actress and model. She has performed in leading roles in a variety of films, ranging from romantic comedies and dramas to science fiction and action films.',
            'https://m.media-amazon.com/images/M/MV5BMjMxNzk1MTQyMl5BMl5BanBnXkFtZTgwMDIzMDEyMTE@._V1_FMjpg_UX1000_.jpg');
        $this->createActor('John Travolta',
            'John Travolta is an American actor, film producer, dancer, and singer. He rose to fame during the 1970s, appearing on the television series "Welcome Back, Kotter" and starring in the box office successes "Saturday Night Fever" and "Grease".',
            'https://m.media-amazon.com/images/M/MV5BMTMyMjZlYzgtZWRjMC00OTRmLTllZTktMmM1ODVmNjljMTQyXkEyXkFqcGdeQXVyMTExNzQ3MzAw._V1_FMjpg_UX1000_.jpg');
        $this->createActor('Bruce Willis',
            'Bruce Willis is an American actor and film producer. His career began on the Off-Broadway stage in the 1970s.',
            'https://m.media-amazon.com/images/M/MV5BMjA0MjMzMTE5OF5BMl5BanBnXkFtZTcwMzQ2ODE3Mw@@._V1_FMjpg_UX1000_.jpg');
        $this->createActor('Cyllian Murphy',
            'Cyllian Murphy is an Irish actor. He began his career performing as a rock musician. After turning down a record deal, he began his acting career in theatre, and in short and independent films in the late 1990s.',
            'https://m.media-amazon.com/images/M/MV5BMDUxY2M1NTQtNzcwNC00ZDljLTk4YjctYzJjZGNiYTc0YTE1XkEyXkFqcGdeQXVyMTY5MDA5MDc3._V1_FMjpg_UX1000_.jpg');
        $this->createActor('Emily Blunt',
            'Emily Blunt is a British-American actress. She is the recipient of several accolades, including a Golden Globe Award and a Screen Actors Guild Award, and has been nominated for two British Academy Film Awards.',
            'https://m.media-amazon.com/images/M/MV5BMTUxNDY4MTMzM15BMl5BanBnXkFtZTcwMjg5NzM2Ng@@._V1_FMjpg_UX1000_.jpg');
    }

    private function createActor($name, $description, $photoURL)
    {
        Actor::where('name', $name)->delete();

        return Actor::create([
            'name' => $name,
            'description' => $description,
            'photo' => $photoURL
        ]);
    }
}
