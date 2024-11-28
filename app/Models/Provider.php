<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Traits\BelongsToTeam;
use Database\Factories\ProviderFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string|null $team_id
 * @property string $name
 * @property string|null $display_name
 * @property \App\Models\Enums\ProviderType $type
 * @property \App\Models\Enums\Provider $provider
 * @property mixed|null $client_id
 * @property mixed|null $client_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Connection> $connections
 * @property-read int|null $connections_count
 * @property-read mixed $login_url
 * @property-read mixed $redirect_url
 * @property-read \App\Models\Team|null $team
 *
 * @method static \Database\Factories\ProviderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
#[ApiResource]
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
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'client_id',
        'client_secret',
    ];

    public function connections(): BelongsToMany
    {
        return $this->belongsToMany(Connection::class, 'connections_providers')
            ->withTimestamps();
    }

    public function loginUrl(): Attribute
    {
        return Attribute::get(function ($value, $attributes = null) {
            return route('login.providers');
        });
    }

    public function redirectUrl(): Attribute
    {
        return Attribute::get(function ($value, $attributes = null) {});
    }

    /**
     * @return string[]
     */
    public function casts(): array
    {
        return [
            'type' => Enums\ProviderType::class,
            'provider' => Enums\Provider::class,
            'client_id' => 'encrypted',
            'client_secret' => 'encrypted',
        ];
    }
}
