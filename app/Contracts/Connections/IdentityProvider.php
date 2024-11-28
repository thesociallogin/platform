<?php

namespace App\Contracts\Connections;

use App\Models\Provider;
use App\Models\Team;
use Illuminate\Http\Request;

interface IdentityProvider
{
    public function respondToLoginRequest(Request $request, Team $team, Provider $provider);
}
