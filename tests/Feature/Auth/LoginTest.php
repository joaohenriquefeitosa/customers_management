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
        $data = [
            'email' => 'operacional@manager.com',
            'password' => 'manager123'
        ];

        $this->json('POST', route('login'), $data, ['Accept' => 'application/json'])->assertStatus(200);
    }
}
