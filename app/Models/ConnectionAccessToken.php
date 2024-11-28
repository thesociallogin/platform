<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\BelongsToUser;
use App\Traits\CanBeRevoked;
use Database\Factories\ConnectionTokenFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property string|null $connection_id
 * @property string|null $name
 * @property array|null $scopes
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Connection|null $connection
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken revoked()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionAccessToken whereUserId($value)
 *
 * @mixin \Eloquent
 */
class ConnectionAccessToken extends Model
{
    /** @use HasFactory<ConnectionTokenFactory> */
    use BelongsToTeam, BelongsToUser, CanBeRevoked, HasFactory, HasUuids;

    protected $table = 'connections_access_tokens';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'team_id',
        'connection_id',
        'name',
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
