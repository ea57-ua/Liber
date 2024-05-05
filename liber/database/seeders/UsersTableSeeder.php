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
        $this->createUser('John Doe', 'johndoe@gmail.com', false, false, 'https://pbs.twimg.com/profile_images/1235557963395457024/MgbUq1xp_400x400.jpg');
        $this->createUser('Nicole Stuart', 'stuart@gmail.com', false, false, 'https://img.freepik.com/free-photo/portrait-happy-woman_186202-621.jpg');
        $this->createUser('Juan Gonzales', 'juan@gmail.com', false, false, 'https://images14.eitb.eus/multimedia/recursos/participantes/concursantes/la_caza/2023/salvajes/fitxa_juan.jpg');
        $this->createUser('Vladimir Harkonnen', 'vlad@gmail.com', true, false, 'https://media.licdn.com/dms/image/C4E03AQHGnCmvLyp7zA/profile-displayphoto-shrink_800_800/0/1649702914140?e=2147483647&v=beta&t=EBIkOfJIyBPr-4p2UzrfxOk64t3Z-osIbL43NdR4gbA');
        $this->createUser('Jessica Gomez', 'jessica@gmail.com', false, false, 'https://media.fashionnetwork.com/cdn-cgi/image/fit=contain,width=1000,height=1000/m/35e8/8242/6c7e/76fb/de25/aed8/ceb9/4e8c/0752/e30c/e30c.jpg');
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
