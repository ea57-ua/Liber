<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    private $newuser= [
        'name' => 'Test',
        'surname' => 'Test',
        'email' => 'test@gmail.com',
        'email_verified_at' => null,
    ];
}
