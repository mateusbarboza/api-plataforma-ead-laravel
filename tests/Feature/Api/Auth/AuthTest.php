<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use UtilsTrait;

    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test_erro_logout()
    {

        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $token = $this->createTokenUser();

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

    public function test_erro_get_me()
    {

        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }

    public function test_get_me()
    {
        $token = $this->createTokenUser();

        $response = $this->getJson('/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }
}
