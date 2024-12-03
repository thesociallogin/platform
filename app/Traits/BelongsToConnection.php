<?php

namespace App\Traits;

use App\Models\Connection;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
trait BelongsToConnection
{
    public function connection(): BelongsTo
    {
        return $this->belongsTo(Connection::class);
    }
}
