<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $this->createUser('user', 'user@liber.com', false, false);
        $this->createUser('critic user', 'critic@liber.com', true, false);
        $this->createUser('admin', 'admin@liber.com', false, true);
        $this->createUser('john doe', 'johndoe@gmail.com', false, false, 'https://pbs.twimg.com/profile_images/1235557963395457024/MgbUq1xp_400x400.jpg');
    }

    private function createUser($name, $email, $critic, $admin, $image = '/img/defaultUserImage.png' ): void
    {
        User::where('email', $email)->delete();

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('12341234'),
            'critic' => $critic,
            'admin' => $admin,
            'image' => $image,
            'email_verified_at' => now()
        ]);
    }
}
