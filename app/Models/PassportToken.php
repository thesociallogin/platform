<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use Laravel\Passport\Token;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property string $client_id
 * @property string|null $name
 * @property array|null $scopes
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property-read \App\Models\PassportClient|null $client
 * @property-read \Laravel\Passport\RefreshToken|null $refreshToken
 * @property-read \App\Models\Team|null $team
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportToken whereUserId($value)
 *
 * @mixin \Eloquent
 */
class PassportToken extends Token
{
    use BelongsToTeam;
}
