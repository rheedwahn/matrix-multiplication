<?php

namespace Tests\Feature\Api\Me;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeTest extends TestCase
{
    public function test_an_unauthenticated_user_cannot_access_authenticated_resource()
    {
        $response = $this->getJson('/api/me');
        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function test_logged_in_user_can_get_profile()
    {
        $user = $this->setUpUser();
        $response = $this->actingAs($user)->getJson('/api/me');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
