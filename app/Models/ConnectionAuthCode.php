<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\BelongsToUser;
use App\Traits\CanBeRevoked;
use Database\Factories\ConnectionAuthCodeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property string|null $connection_id
 * @property array|null $scopes
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Connection|null $connection
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode active()
 * @method static \Database\Factories\ConnectionAuthCodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode revoked()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAuthCode whereUserId($value)
 *
 * @mixin \Eloquent
 */
class ConnectionAuthCode extends Model
{
    /** @use HasFactory<ConnectionAuthCodeFactory> */
    use BelongsToTeam, BelongsToUser, CanBeRevoked, HasFactory;

    protected $table = 'connections_auth_codes';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'team_id',
        'connection_id',
        'scopes',
        'revoked',
        'expires_at',
    ];

    public function connection(): BelongsTo
    {
        return $this->belongsTo(Connection::class);
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'scopes' => 'array',
            'revoked' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }
}
