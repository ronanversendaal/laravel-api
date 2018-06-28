<?php

namespace Tests;

use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAuthenticatedUser()
    {
        $this->user  = factory(\App\User::class)->create();

        $this->token = auth()->login($this->user);

        $payload = auth()->payload();

        return $this->setAuthenticationHeader($this->token);        
    }


    protected function setAuthenticationHeader($jwt_token){
        return $this->withHeaders([
            'Authorization' => 'Bearer '.$jwt_token,
        ]);
    }
}
