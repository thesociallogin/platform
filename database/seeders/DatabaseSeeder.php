<?php

namespace Database\Seeders;

use App\Models\Connection;
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

        $connection = Connection::factory()->forPostman()->state([
            'id' => '9d999856-4664-4cf3-8df8-a7b408a42a73',
            'name' => 'Connection 1',
            'team_id' => $team->getKey(),
        ])->create();

        $oAuthProvider = Provider::factory()->state([
            'id' => '9d999856-44ed-4ece-8c4a-a4c3a6cc3580',
            'name' => 'Test OAuth 2.0 Provider',
            'provider' => \App\Models\Enums\Provider::OAUTH2,
            'team_id' => $team->getKey(),
        ])->create();
        $oAuthProvider->connections()->attach($connection);

        /** @var ClientRepository $client */
        $clientRepository = app()->make(ClientRepository::class);
        $client = $clientRepository->create(
            userId: null,
            name: 'Test OAuth Provider',
            redirect: $oAuthProvider->redirect_url,
        );

        $oAuthProvider->forceFill([
            'client_id' => $client->getKey(),
            'client_secret' => $client->plainSecret,
            'authorization_endpoint' => route('passport.authorizations.authorize'),
            'token_endpoint' => route('passport.token'),
            'userinfo_endpoint' => route('api.me'),
            'userinfo_id' => 'data.id',
            'userinfo_name' => 'data.name',
            'userinfo_email' => 'data.email',
            'scopes' => ['openid', 'profile', 'email'],
        ])->save();

        $passwordlessEmailProvider = Provider::factory()->state([
            'id' => '9d999856-44ed-4ece-8c4a-a4c3a6cc3581',
            'name' => 'Test Passwordless Email Provider',
            'provider' => \App\Models\Enums\Provider::EMAIL,
            'team_id' => $team->getKey(),
        ])->create();
        $passwordlessEmailProvider->connections()->attach($connection);

        $passwordlessSmsProvider = Provider::factory()->state([
            'id' => '9d999856-44ed-4ece-8c4a-a4c3a6cc3582',
            'name' => 'Test Passwordless SMS Provider',
            'provider' => \App\Models\Enums\Provider::SMS,
            'team_id' => $team->getKey(),
        ])->create();
        $passwordlessSmsProvider->connections()->attach($connection);
    }
}
