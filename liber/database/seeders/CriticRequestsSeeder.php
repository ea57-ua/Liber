<?php

namespace Database\Seeders;

use App\Enums\CriticRequestState;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CriticRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $requestStateValues = CriticRequestState::cases();

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
            $numRequests = rand(1, 3);

            for ($i = 0; $i < $numRequests; $i++) {
                $user->criticRequests()->create([
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'file' => null,
                    'state' => $requestStateValues[array_rand($requestStateValues)]
                ]);
            }
        }

    }
}
