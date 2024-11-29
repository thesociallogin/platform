<?php

namespace App\Models;

use Database\Factories\ConnectionRequestFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $redirect_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ConnectionRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest whereRedirectUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConnectionRequest whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ConnectionRequest extends Model
{
    /** @use HasFactory<ConnectionRequestFactory> */
    use HasFactory, HasUuids;

    protected $table = 'connections_requests';

    /**
     * @var string[]
     */
    protected $fillable = [
        'redirect_url',
    ];
}
