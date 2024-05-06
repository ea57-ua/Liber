<?php

namespace Database\Seeders;

use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $user = User::where('email', 'user@liber.com')->first();
        $critic = User::where('email', 'critic@liber.com')->first();
        $admin = User::where('email', 'admin@liber.com')->first();

        $conversations = [
            ['from' => $user, 'to' => $critic],
            ['from' => $user, 'to' => $admin],
        ];

        foreach ($conversations as $conversation) {
            $numMessages = rand(15, 50);

            for ($i = 0; $i < $numMessages; $i++) {
                $message = new ChMessage();
                if ($i % 2 == 0) {
                    $message->from_id = $conversation['from']->id;
                    $message->to_id = $conversation['to']->id;
                } else {
                    $message->from_id = $conversation['to']->id;
                    $message->to_id = $conversation['from']->id;
                }
                $message->body = $faker->sentence;
                $message->save();
            }
        }
    }
}
