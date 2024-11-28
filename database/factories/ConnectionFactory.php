<?php

namespace Database\Factories;

use App\Models\Connection;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Connection>
 */
class ConnectionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->name,
            'secret' => Str::random(40),
            'redirect_url' => $this->faker->url,
        ];
    }

    public function forPostman(): static
    {
        return $this->state([
            'redirect_url' => 'https://oauth.pstmn.io/v1/callback',
        ]);
    }
}
