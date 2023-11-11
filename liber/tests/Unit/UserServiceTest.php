<?php

namespace Tests\Unit;

use App\DTO\UserDTO;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_createUser() {
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
}
