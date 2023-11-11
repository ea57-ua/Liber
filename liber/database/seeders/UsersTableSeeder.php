<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $admin = new User([
            'name' => 'Admin',
            'surname' => 'user',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
        ]);
        $admin->save();

        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('users')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'email' => $faker->email(),
                'password' => Hash::make('1234'),
                'biography' => $faker->paragraph(),
                'admin' => false,
            ]);
        }
    }
}
