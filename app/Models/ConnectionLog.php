<?php

namespace App\Models;

use App\Traits\BelongsToConnection;
use App\Traits\BelongsToProvider;
use App\Traits\BelongsToUser;
use Database\Factories\ConnectionLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
