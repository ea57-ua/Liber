<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_delete_user() {
        $user = User::create([
            'name' => 'Test',
            'surname' => 'Test',
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        $user = User::findOrFail($user->id);
        $user->delete();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_get_user_by_id()
    {
        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('secret'),
        ]);

        $retrievedUser = User::findOrFail($user->id);

        $this->assertEquals($user->id, $retrievedUser->id);
        $this->assertEquals($user->name, $retrievedUser->name);
        $this->assertEquals($user->surname, $retrievedUser->surname);
        $this->assertEquals($user->email, $retrievedUser->email);
    }
}

/*
    sudo apt-get install php-gd
    sudo service apache2 restart
 */
