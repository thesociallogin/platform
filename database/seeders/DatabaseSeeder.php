<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\Provider;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $team = Team::factory()->state([
            'name' => 'Test Team',
            'email' => 'test@deschutesdesigngroup.com',
            'slug' => 'test',
        ])->has(User::factory()->state([
            'name' => 'Test User',
            'email' => 'test@deschutesdesigngroup.com',
        ]))->has(Provider::factory()->state([
            'name' => 'Provider 1',
        ]), 'providers')->has(Connection::factory()->state([
            'name' => 'Connection 1',
        ]), 'connections')->create();

    }
}
