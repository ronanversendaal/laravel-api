<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * Going to the index should give a 301 redirect to https://ronanversendaal.com
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        
        $response->assertStatus(301);
        $response->assertRedirect('https://ronanversendaal.com');
        
    }
}
