<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{   
    public function testAuthorizedResponse()
    {
        // $this->createAuthenticatedUser();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
    }

    public function testShouldReturnUnauthorisedResponse()
    {
        $response = $this->post('/v1/auth/me');

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Token not provided']);
    }

    public function testLoginResponse()
    {

        $this->createAuthenticatedUser();

        $response = $this->post('/v1/auth/me');

        $response->assertStatus(200);
        $response->assertJson(['name' => $this->user->name]);
    }

    public function testLogoutResponse()
    {

        $this->createAuthenticatedUser();

        $response = $this->post('/v1/auth/logout');

        $response->assertStatus(200);
    }
}
