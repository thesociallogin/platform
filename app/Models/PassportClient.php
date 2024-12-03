<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\Client;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property string|null $connection_id
 * @property string $name
 * @property string|null $secret
 * @property string|null $provider
 * @property string $redirect
 * @property bool $personal_access_client
 * @property bool $password_client
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\AuthCode> $authCodes
 * @property-read int|null $auth_codes_count
 * @property-read \App\Models\Connection|null $connection
 * @property-read string|null $plain_secret
 * @property-read \App\Models\Team|null $team
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PassportToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Laravel\Passport\Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient wherePasswordClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient wherePersonalAccessClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PassportClient whereUserId($value)
 *
 * @mixin \Eloquent
 */
class PassportClient extends Client
{
    use BelongsToTeam;

    public function connection(): BelongsTo
    {
        return $this->belongsTo(Connection::class);
    }
}
