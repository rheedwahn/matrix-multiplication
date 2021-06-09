<?php

namespace Tests\Feature\Api\Authentication;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_it_validates_email_when_login_in()
    {
        $data = [];
        $response = $this->makePost('/api/auth/login', $data);
        $response->assertStatus(422);
        $keys = ['password', 'email'];
        $response->assertJsonValidationErrors($keys);
    }

    public function test_user_can_login()
    {
        $user = $this->setUpUser();
        $data = ['email' => $user->email, 'password' => 'password'];
        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'token_type' => 'Bearer'
        ]);
    }

    public function test_a_user_can_logout_after_logged_in()
    {
        $user = $this->setUpUser();
        $response = $this->makeAuthGet($user, '/api/auth/logout');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Successfully logged out'
        ]);
    }
}
