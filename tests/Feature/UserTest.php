<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use UserTrait;

    public function testCreateUser()
    {
        $user = $this->createUser('Test1', 'test1@gmail.com', 'password');
        $this->assertDatabaseHas('users', [
            'email' => 'test1@gmail.com',
        ]);
    }

    public function testAuthenticateUser()
    {
        $user = $this->createUser('Test2', 'test2@gmail.com', 'password');
        $token = $this->loginUser('test2@gmail.com', 'password');
        $this->assertAuthenticated();
    }

    public function testDeleteUser()
    {
        $user = $this->createUser('Test3', 'test3@gmail.com', 'password');
        $this->deleteUser('test3@gmail.com');
        $this->assertDatabaseMissing('users', [
            'email' => 'test3@gmail.com',
        ]);
    }
}
