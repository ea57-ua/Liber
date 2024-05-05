<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            User::where('email', 'user@liber.com')->first(),
            User::where('email', 'critic@liber.com')->first(),
            User::where('email', 'admin@liber.com')->first(),
            User::where('email', 'johndoe@gmail.com')->first(),
            User::where('email', 'stuart@gmail.com')->first(),
            User::where('email', 'juan@gmail.com')->first(),
            User::where('email', 'vlad@gmail.com')->first(),
            User::where('email', 'jessica@gmail.com')->first()
        ];

        foreach ($users as $user) {
            foreach ($users as $otherUser) {
                if ($user->id != $otherUser->id && rand(1, 10) <= 7) {
                    $user->follows()->attach($otherUser->id);
                }
            }
        }
    }
}
