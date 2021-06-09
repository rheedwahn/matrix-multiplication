<?php

namespace Tests\Unit\Api\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_hash_password_correctly()
    {
        $password = 'password';

        $user = User::factory(1)->create([
            'password' => $password
        ]);
        $this->assertTrue(Hash::check($password, $user->first()->password));
    }
}
