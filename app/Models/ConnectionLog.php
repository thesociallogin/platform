<?php

namespace App\Models;

use App\Traits\BelongsToConnection;
use App\Traits\BelongsToProvider;
use App\Traits\BelongsToUser;
use Database\Factories\ConnectionLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $connection_id
 * @property string|null $user_id
 * @property string|null $provider_id
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Connection|null $connection
 * @property-read \App\Models\Provider|null $provider
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\ConnectionLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionLog whereUserId($value)
 *
 * @mixin \Eloquent
 */
class ConnectionLog extends Model
{
    /** @use HasFactory<ConnectionLogFactory> */
    use BelongsToConnection, BelongsToProvider, BelongsToUser, HasFactory;

    protected $table = 'connections_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'connection_id',
        'user_id',
        'provider_id',
        'ip',
    ];
}
