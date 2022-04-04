<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;

class ClientTest extends TestCase
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

    public function testIndexWithSuccess()
    {
        // Loga com usuário 1
        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('GET', route('client.index'), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testShowWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $data = [
            'client_name' => Str::random(6),
            'client_document' => '55.913.605/0001-65',
            'foundation_date' => \Carbon\Carbon::now(),
            'group_id' => $group->id,
        ];
        $client = Client::create($data);

        $user = User::where('email', 'admin@manager.com')->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $response = $this->json('GET', route('client.show', $client->id), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testStoreWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $data = [
            'client_name' => Str::random(6),
            'client_document' => '54.705.533/0001-06',
            'foundation_date' => \Carbon\Carbon::now(),
            'group_id' => $group->id,
        ];

        $response = $this->json('POST', route('client.store'), $data, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }


    public function testUpdateWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $data = [
            'client_name' => Str::random(6),
            'client_document' => '53.635.641/0001-89',
            'foundation_date' => \Carbon\Carbon::now(),
            'group_id' => $group->id,
        ];
        $client = Client::create($data);

        $data['client_name'] = $data['client_name'] . ' Altered';

        $response = $this->json('PUT', route('client.update', $client->id), $data, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testDestroyWithSuccess()
    {
        $data = [
            'group_name' => Str::random(6),
        ];
        $group = Group::create($data);

        $data = [
            'client_name' => Str::random(6),
            'client_document' => '12.960.257/0001-74',
            'foundation_date' => \Carbon\Carbon::now(),
            'group_id' => $group->id,
        ];
        $client = Client::create($data);

        $response = $this->json('DELETE', route('client.destroy', $client->id), [], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }

    public function testChangeGroupWithSuccess()
    {
        $old = [
            'group_name' => Str::random(6),
        ];
        $groupOld = Group::create($old);

        $new = [
            'group_name' => Str::random(6),
        ];
        $groupNew = Group::create($new);

        $data = [
            'client_name' => Str::random(6),
            'client_document' => '53.635.641/0001-89',
            'foundation_date' => \Carbon\Carbon::now(),
            'group_id' => $groupOld->id,
        ];
        $client = Client::create($data);

        $data = [
            'client_id' => $client->id,
            'group_id' => $groupNew->id,
        ];

        $response = $this->json('POST', route('client.changeGroup'), $data, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token])->assertStatus(200);
    }
}
