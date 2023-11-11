<?php

namespace Tests\Unit;

use App\DTO\UserDTO;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_create_user() {
        $userDto = new UserDTO();
        $userDto->setName('Test');
        $userDto->setSurname('Test');
        $userDto->setEmail('test@gmail.com');
        $userDto->setPassword('12345678');
        $userDto->setBiography('Test');
        $userDto->setAdmin(0);

        $this->userService->createUser($userDto);

        $this->assertDatabaseHas('users', [
            'email' => 'test@gmail.com',
            ]);
    }

    public function test_delete_user() {
        $user = User::create([
            'name' => 'Test',
            'surname' => 'Test',
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        $this->userService->deleteUser($user->id);
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

        $retrievedUser = $this->userService->getUserById($user->id);

        $this->assertEquals($user->id, $retrievedUser->id);
        $this->assertEquals($user->name, $retrievedUser->name);
        $this->assertEquals($user->surname, $retrievedUser->surname);
        $this->assertEquals($user->email, $retrievedUser->email);
    }
    public function test_add_image_to_user()
    {
        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('secret'),
        ]);

        $image = UploadedFile::fake()->image('test_image.jpg');

        $this->userService->addImageToUser($user->id, $image);

        $this->assertDatabaseHas('users', ['id' => $user->id,
            'image' => 'images/user_images/' . $user->id . '_user.jpg']);
    }

    public function test_edit_user()
    {
        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('secret'),
            'biography' => 'Old Biography',
            'admin' => false,
        ]);

        $updatedUserDto = new UserDTO();
        $updatedUserDto->setName('Updated John');
        $updatedUserDto->setSurname('Updated Doe');
        $updatedUserDto->setEmail('updated.doe@example.com');
        $updatedUserDto->setPassword('newpassword');
        $updatedUserDto->setBiography('New Biography');
        $updatedUserDto->setAdmin(true);

        $this->userService->editUser($user->id, $updatedUserDto);
        $user = $user->fresh();

        $this->assertEquals('Updated John', $user->name);
        $this->assertEquals('Updated Doe', $user->surname);
        $this->assertEquals('updated.doe@example.com', $user->email);
        $this->assertTrue(Hash::check('newpassword', $user->password));
        $this->assertEquals('New Biography', $user->biography);
        $this->assertTrue($user->admin==1);
    }
}

/*
    sudo apt-get install php-gd
    sudo service apache2 restart
 */
