<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\Enums\ProviderType;
use App\Models\Provider;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class DatabaseSeeder extends Seeder
{
    //use WithoutModelEvents;

    public function run(): void
    {
        $team = Team::factory()->state([
            'name' => 'Test Team',
            'email' => 'test@deschutesdesigngroup.com',
            'slug' => 'test',
        ])->has(User::factory()->state([
            'name' => 'Test User',
            'email' => 'test@deschutesdesigngroup.com',
        ]))->create();

        $provider = Provider::factory()->state([
            'id' => '9d999856-44ed-4ece-8c4a-a4c3a6cc3580',
            'name' => 'Provider 1',
            'type' => ProviderType::OAUTH,
            'provider' => \App\Models\Enums\Provider::OAUTH2,
            'team_id' => $team->getKey(),
        ])->has(Connection::factory()->forPostman()->state([
            'id' => '9d999856-4664-4cf3-8df8-a7b408a42a73',
            'name' => 'Connection 1',
            'team_id' => $team->getKey(),
        ]), 'connections')->create();

        /** @var ClientRepository $client */
        $clientRepository = app()->make(ClientRepository::class);
        $client = $clientRepository->create(
            userId: null,
            name: 'Test OAuth Provider',
            redirect: $redirectUrl = route('login.callback', [
                'provider' => $provider,
            ]),
        );

        $provider->forceFill([
            'client_id' => $client->getKey(),
            'client_secret' => $client->plainSecret,
            'authorization_endpoint' => route('passport.authorizations.authorize'),
            'token_endpoint' => route('passport.token'),
            'userinfo_endpoint' => route('api.me'),
            'userinfo_id' => 'data.id',
            'userinfo_name' => 'data.name',
            'userinfo_email' => 'data.email',
            'redirect_url' => $redirectUrl,
            'scopes' => ['openid', 'profile', 'email'],
        ])->save();
    }
}
