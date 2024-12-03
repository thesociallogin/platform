<?php

namespace App\Actions;

use App\Models\Connection;
use App\Models\PassportClient;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class CreatePassportClient
{
    public static function handle(Connection $connection): Client
    {
        /** @var ClientRepository $clientRepository */
        $clientRepository = app(ClientRepository::class);

        /** @var PassportClient $client */
        $client = $clientRepository->create(
            userId: null,
            name: $connection->name,
            redirect: $connection->redirect_url
        );

        $client->team()->associate($connection->team)->save();

        $client->forceFill([
            'connection_id' => $connection->getKey(),
        ])->save();

        return $client;
    }
}
