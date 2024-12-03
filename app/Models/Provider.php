<?php

namespace App\Models;

use App\Models\Enums\ProviderType;
use App\Traits\BelongsToTeam;
use Database\Factories\ProviderFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use League\OAuth2\Client\Provider\AbstractProvider;

/**
 * @property string $id
 * @property string|null $team_id
 * @property string $name
 * @property string|null $display_name
 * @property \App\Models\Enums\Provider $provider
 * @property mixed|null $client_id
 * @property mixed|null $client_secret
 * @property string|null $authorization_endpoint
 * @property string|null $token_endpoint
 * @property string|null $userinfo_endpoint
 * @property string|null $userinfo_id
 * @property string|null $userinfo_name
 * @property string|null $userinfo_email
 * @property array|null $scopes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property ProviderType $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Connection> $connections
 * @property-read int|null $connections_count
 * @property-read mixed $redirect_url
 * @property-read \App\Models\Team|null $team
 * @property-read \App\Models\UserLink|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 *
 * @method static \Database\Factories\ProviderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereAuthorizationEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereTokenEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUserinfoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUserinfoEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUserinfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUserinfoName($value)
 *
 * @mixin \Eloquent
 */
class Provider extends Model
{
    /** @use HasFactory<ProviderFactory> */
    use BelongsToTeam, HasFactory, HasUuids;

    /**
     * @var string[]
     */
    protected $fillable = [
        'team_id',
        'name',
        'display_name',
        'type',
        'provider',
        'client_id',
        'client_secret',
        'authorization_endpoint',
        'token_endpoint',
        'userinfo_endpoint',
        'userinfo_id',
        'userinfo_name',
        'userinfo_email',
        'scopes',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'type',
    ];

    public function connections(): BelongsToMany
    {
        return $this->belongsToMany(Connection::class, 'connections_providers')
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_links')
            ->withTimestamps()
            ->using(UserLink::class);
    }

    public function name(): Attribute
    {
        return Attribute::get(fn ($value, $attributes = null) => data_get($attributes, 'display_name') ?? data_get($attributes, 'name'))
            ->shouldCache();
    }

    public function redirectUrl(): Attribute
    {
        return Attribute::get(fn () => route('login.callback', [
            'provider' => $this,
        ]))->shouldCache();
    }

    public function type(): Attribute
    {
        return Attribute::get(function ($value, $attributes = null): ?ProviderType {
            $provider = Enums\Provider::from(data_get($attributes, 'provider'));

            return match (true) {
                $provider === Enums\Provider::EMAIL, $provider === Enums\Provider::SMS => ProviderType::PASSWORDLESS,
                is_subclass_of($provider, AbstractProvider::class) => ProviderType::OAUTH,
                default => null
            };
        })->shouldCache();
    }

    /**
     * @return string[]
     */
    public function casts(): array
    {
        return [
            'provider' => Enums\Provider::class,
            'client_id' => 'encrypted',
            'client_secret' => 'encrypted',
            'scopes' => 'array',
        ];
    }
}
