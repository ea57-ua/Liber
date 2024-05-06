<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = ['Spam',
                        'Harassment',
                        'Inappropriate Content',
                        'Privacy Violation',
                        'Bullying',
                        'Other'];

        $users = [
            User::where('email', 'johndoe@gmail.com')->first(),
            User::where('email', 'stuart@gmail.com')->first(),
            User::where('email', 'juan@gmail.com')->first(),
            User::where('email', 'vlad@gmail.com')->first(),
            User::where('email', 'jessica@gmail.com')->first(),
        ];

        foreach ($users as $user) {
            $userPosts = Post::where('user_id', $user->id)->get();

            $numReports = rand(1, 3);

            for ($i = 0; $i < $numReports; $i++) {
                $otherUser = $users[array_rand($users)];
                while ($otherUser->id === $user->id) {
                    $otherUser = $users[array_rand($users)];
                }
                $otherUserPost = Post::where('user_id', $otherUser->id)->inRandomOrder()->first();

                $report = new Report();
                $report->reason = $faker->sentence;
                $report->category = $categories[array_rand($categories)];
                $report->post_id = $otherUserPost->id;
                $report->user_id = $user->id;
                $report->save();
            }
        }
    }
}
