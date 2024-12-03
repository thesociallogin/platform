<?php

namespace App\Models;

use App\Actions\CreatePassportClient;
use App\Traits\BelongsToTeam;
use App\Traits\BelongsToUser;
use App\Traits\CanBeRevoked;
use Database\Factories\ConnectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property string $name
 * @property string|null $description
 * @property mixed|null $secret
 * @property array|null $scopes
 * @property string $redirect_url
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PassportClient|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Provider> $providers
 * @property-read int|null $providers_count
 * @property-read mixed $sso_url
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\User|null $user
 *
 * @method static Builder<static>|Connection active()
 * @method static \Database\Factories\ConnectionFactory factory($count = null, $state = [])
 * @method static Builder<static>|Connection newModelQuery()
 * @method static Builder<static>|Connection newQuery()
 * @method static Builder<static>|Connection query()
 * @method static Builder<static>|Connection revoked()
 * @method static Builder<static>|Connection whereCreatedAt($value)
 * @method static Builder<static>|Connection whereDescription($value)
 * @method static Builder<static>|Connection whereId($value)
 * @method static Builder<static>|Connection whereName($value)
 * @method static Builder<static>|Connection whereRedirectUrl($value)
 * @method static Builder<static>|Connection whereRevoked($value)
 * @method static Builder<static>|Connection whereScopes($value)
 * @method static Builder<static>|Connection whereSecret($value)
 * @method static Builder<static>|Connection whereTeamId($value)
 * @method static Builder<static>|Connection whereUpdatedAt($value)
 * @method static Builder<static>|Connection whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Connection extends Model
{
    /** @use HasFactory<ConnectionFactory> */
    use BelongsToTeam, BelongsToUser, CanBeRevoked, HasFactory, HasUuids;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'team_id',
        'name',
        'redirect_url',
        'secret',
        'scopes',
        'revoked',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::created(function (Connection $connection) {
            CreatePassportClient::handle($connection);
        });
    }

    public function client(): HasOne
    {
        return $this->hasOne(PassportClient::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ConnectionLog::class);
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class, 'connections_providers')
            ->withTimestamps();
    }

    public function ssoUrl(): Attribute
    {
        return Attribute::get(function () {
            return route('passport.authorizations.authorize', [
                'client_id' => $this->client->getKey(),
                'response_type' => 'code',
                'redirect_url' => $this->client->redirect,
                'state' => Str::random(),
                'scope' => 'openid',
            ]);
        });
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'secret' => 'encrypted',
            'scopes' => 'array',
            'revoked' => 'boolean',
        ];
    }
}
