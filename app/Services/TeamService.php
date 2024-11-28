<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public static function currentTeam(): ?Team
    {
        /** @var Team $team */
        $team = request()->route('team') ?? null;

        return $team;
    }
}
