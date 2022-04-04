<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;

class GroupTest extends TestCase
{
    use DatabaseTransactions;

    private $token;

    public function setUp(): Void
    {
        parent::setUp();
        // Loga com usuário 1
        $user = User::where('email', 'admin@manager.com')->first();
        $this->token = $user->createToken('LaravelAuthApp')->accessToken;
    }
    
    public function testStoreWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];

        $response = $this->json('POST', route('group.store'), $data, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testIndexWithSuccess()
    {
        // Loga com usuário 1
        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('GET', route('group.index'), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testShowWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('GET', route('group.show', $group->id), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testUpdateWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];

        $group = Group::create($data);


        $data = [
            'group_name' => Str::random(7),
        ];

        // Loga com usuário 1
        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('PUT', route('group.update', $group->id), $data, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testDestroyWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('delete', route('group.destroy', $group->id), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }
}
