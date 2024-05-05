<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Symfony\Component\Translation\t;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $johndoe = User::where('email', 'johndoe@gmail.com')->first();
        $nicole = User::where('email', 'stuart@gmail.com')->first();
        $juan = User::where('email', 'juan@gmail.com')->first();
        $vladimir = User::where('email', 'vlad@gmail.com')->first();
        $jessica = User::where('email', 'jessica@gmail.com')->first();

        $post1John = $this->createPost('Can we discuss the symbolism in the latest Tarantino film?',
            $johndoe->id, null, 'https://static1.srcdn.com/wordpress/wp-content/uploads/2020/04/Featured-Image-Tarantino-poster-collage.jpg');
        $post1nicole = $this->createPost('I\'m looking for some good indie films to watch. I love movies that make me think and challenge the status quo. Any suggestions?',
            $nicole->id, null, '');
        $post1juan = $this->createPost('La nueva película de Nolan tiene algunas de las mejores cinematografías que he visto. La forma en que usa la luz y la sombra es simplemente impresionante.',
            $juan->id, null,
            'https://preview.redd.it/i-keep-thinking-about-this-scene-its-definitely-one-of-the-v0-7aafvueucggb1.jpg?width=1080&crop=smart&auto=webp&s=25b83b5c09260ea802767c658a720384ca324f2d');
        $post1vladimir = $this->createPost('I think that the new Dune movie is going to be a masterpiece. The visuals are stunning and the cast is amazing. What do you think?',
            $vladimir->id, null,
            'https://static1.srcdn.com/wordpress/wp-content/uploads/2021/10/Dune-Bene-Gessirit-Sisters.jpg');
        $post1jessica = $this->createPost('I just watched the new Marvel movie and I loved it! The action scenes were amazing and the story was really engaging. What did you think?',
            $jessica->id, null, '');
        $post2John = $this->createPost('Looking for classic film recommendations.',
            $johndoe->id, null, '');
        $post3john = $this->createPost('I like movies that make me think.', $johndoe->id, $post2John->id, '');
        $post2vladimir = $this->createPost('Someone has seen Enemy? I need to talk about it with someone.',
            $vladimir->id, null, 'https://miro.medium.com/v2/resize:fit:1200/1*pDhbE4LQivGKY29cYQrJEw.jpeg');
        $post2jessica = $this->createPost('Alguien de Alicante para ir a ver la nueva película de Joker ?',
            $jessica->id, null,'');
        $post2juan = $this->createPost('Hola Jessica, soy de Alicante, podríamos ir juntos a ver la película.',
            $juan->id, $post2jessica->id, '');
        $post3jessica = $this->createPost('Claro, planeamos fecha y sitio mejor por privado.',
            $jessica->id, $post2juan->id, '');
        $post2nicole = $this->createPost('I love mystery thriler movies like Seven and Zodiac. Any recommendations?',
            $nicole->id, null, 'https://i.ytimg.com/vi/f9cDKbmCD0o/sddefault.jpg');
        $post3john = $this->createPost('Just watched Giorgos Lanthimos\'s last film, Poor Things. I\'ve too much to say about it but I don\'t know where to start.',
            $johndoe->id,null, '');
        $post3vladimir = $this->createPost('Which is your scariest favorite movie? Mine is The Shining.',
            $vladimir->id, null, 'https://s3picturehouses.s3.eu-central-1.amazonaws.com/header/ph_15959311245f1ff9f476aa8.jpg');

        $post3john->likes()->attach($nicole->id);
        $post2jessica->likes()->attach($johndoe->id);
        $post2jessica->likes()->attach($juan->id);
        $post2jessica->likes()->attach($vladimir->id);
        $post2jessica->likes()->attach($nicole->id);
        $post1John->likes()->attach($jessica->id);
        $post1John->likes()->attach($juan->id);
        $post1vladimir->likes()->attach($johndoe->id);
        $post1vladimir->likes()->attach($nicole->id);
        $post1vladimir->likes()->attach($juan->id);
        $post1vladimir->likes()->attach($jessica->id);
        $post1nicole->likes()->attach($johndoe->id);
        $post1nicole->likes()->attach($juan->id);
        $post1nicole->likes()->attach($vladimir->id);
        $post1nicole->likes()->attach($jessica->id);
    }

    private function createPost($text, $user_id, $parent_id, $imageLink) {
        return Post::create([
            'text' => $text,
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'image1' => $imageLink,
            'created_at' => now()
        ]);
    }
}
