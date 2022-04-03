<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginWithSuccess()
    {
        $user = [
            'email' => 'operacional@manager.com',
            'password' => 'manager123'
        ];

        $this->json('POST', route('login'), $user, ['Accept' => 'application/json'])->assertStatus(200);
    }
}
